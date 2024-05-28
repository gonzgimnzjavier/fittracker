/**
 * @license Copyright (c) 2003-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */
/* eslint-disable @typescript-eslint/no-invalid-void-type */
/**
 * @module ui/view
 */
import ViewCollection from './viewcollection.js';
import Template from './template.js';
import { CKEditorError, Collection, DomEmitterMixin, ObservableMixin, isIterable } from '@ckeditor/ckeditor5-utils';
import '../theme/globals/globals.css';
/**
 * The basic view class, which represents an HTML element created out of a
 * {@link module:ui/view~View#template}. Views are building blocks of the user interface and handle
 * interaction
 *
 * Views {@link module:ui/view~View#registerChild aggregate} children in
 * {@link module:ui/view~View#createCollection collections} and manage the life cycle of DOM
 * listeners e.g. by handling rendering and destruction.
 *
 * See the {@link module:ui/template~TemplateDefinition} syntax to learn more about shaping view
 * elements, attributes and listeners.
 *
 * ```ts
 * class SampleView extends View {
 * 	constructor( locale ) {
 * 		super( locale );
 *
 * 		const bind = this.bindTemplate;
 *
 * 		// Views define their interface (state) using observable attributes.
 * 		this.set( 'elementClass', 'bar' );
 *
 * 		this.setTemplate( {
 * 			tag: 'p',
 *
 * 			// The element of the view can be defined with its children.
 * 			children: [
 * 				'Hello',
 * 				{
 * 					tag: 'b',
 * 					children: [ 'world!' ]
 * 				}
 * 			],
 * 			attributes: {
 * 				class: [
 * 					'foo',
 *
 * 					// Observable attributes control the state of the view in DOM.
 * 					bind.to( 'elementClass' )
 * 				]
 * 			},
 * 			on: {
 * 				// Views listen to DOM events and propagate them.
 * 				click: bind.to( 'clicked' )
 * 			}
 * 		} );
 * 	}
 * }
 *
 * const view = new SampleView( locale );
 *
 * view.render();
 *
 * // Append <p class="foo bar">Hello<b>world</b></p> to the <body>
 * document.body.appendChild( view.element );
 *
 * // Change the class attribute to <p class="foo baz">Hello<b>world</b></p>
 * view.elementClass = 'baz';
 *
 * // Respond to the "click" event in DOM by executing a custom action.
 * view.on( 'clicked', () => {
 * 	console.log( 'The view has been clicked!' );
 * } );
 * ```
 */
export default class View extends DomEmitterMixin(ObservableMixin()) {
    /**
     * Creates an instance of the {@link module:ui/view~View} class.
     *
     * Also see {@link #render}.
     *
     * @param locale The localization services instance.
     */
    constructor(locale) {
        super();
        this.element = null;
        this.isRendered = false;
        this.locale = locale;
        this.t = locale && locale.t;
        this._viewCollections = new Collection();
        this._unboundChildren = this.createCollection();
        // Pass parent locale to its children.
        this._viewCollections.on('add', (evt, collection) => {
            collection.locale = locale;
            collection.t = locale && locale.t;
        });
        this.decorate('render');
    }
    /**
     * Shorthand for {@link module:ui/template~Template.bind}, a binding
     * {@link module:ui/template~BindChain interface} pre–configured for the view instance.
     *
     * It provides {@link module:ui/template~BindChain#to `to()`} and
     * {@link module:ui/template~BindChain#if `if()`} methods that initialize bindings with
     * observable attributes and attach DOM listeners.
     *
     * ```ts
     * class SampleView extends View {
     * 	constructor( locale ) {
     * 		super( locale );
     *
     * 		const bind = this.bindTemplate;
     *
     * 		// These {@link module:utils/observablemixin~Observable observable} attributes will control
     * 		// the state of the view in DOM.
     * 		this.set( {
     * 			elementClass: 'foo',
     * 		 	isEnabled: true
     * 		 } );
     *
     * 		this.setTemplate( {
     * 			tag: 'p',
     *
     * 			attributes: {
     * 				// The class HTML attribute will follow elementClass
     * 				// and isEnabled view attributes.
     * 				class: [
     * 					bind.to( 'elementClass' )
     * 					bind.if( 'isEnabled', 'present-when-enabled' )
     * 				]
     * 			},
     *
     * 			on: {
     * 				// The view will fire the "clicked" event upon clicking <p> in DOM.
     * 				click: bind.to( 'clicked' )
     * 			}
     * 		} );
     * 	}
     * }
     * ```
     */
    get bindTemplate() {
        if (this._bindTemplate) {
            return this._bindTemplate;
        }
        return (this._bindTemplate = Template.bind(this, this));
    }
    /**
     * Creates a new collection of views, which can be used as
     * {@link module:ui/template~Template#children} of this view.
     *
     * ```ts
     * class SampleView extends View {
     * 	constructor( locale ) {
     * 		super( locale );
     *
     * 		const child = new ChildView( locale );
     * 		this.items = this.createCollection( [ child ] );
     *
     * 		this.setTemplate( {
     * 			tag: 'p',
     *
     * 			// `items` collection will render here.
     * 			children: this.items
     * 		} );
     * 	}
     * }
     *
     * const view = new SampleView( locale );
     * view.render();
     *
     * // It will append <p><child#element></p> to the <body>.
     * document.body.appendChild( view.element );
     * ```
     *
     * @param views Initial views of the collection.
     * @returns A new collection of view instances.
     */
    createCollection(views) {
        const collection = new ViewCollection(views);
        this._viewCollections.add(collection);
        return collection;
    }
    /**
     * Registers a new child view under the view instance. Once registered, a child
     * view is managed by its parent, including {@link #render rendering}
     * and {@link #destroy destruction}.
     *
     * To revert this, use {@link #deregisterChild}.
     *
     * ```ts
     * class SampleView extends View {
     * 	constructor( locale ) {
     * 		super( locale );
     *
     * 		this.childA = new SomeChildView( locale );
     * 		this.childB = new SomeChildView( locale );
     *
     * 		this.setTemplate( { tag: 'p' } );
     *
     * 		// Register the children.
     * 		this.registerChild( [ this.childA, this.childB ] );
     * 	}
     *
     * 	render() {
     * 		super.render();
     *
     * 		this.element.appendChild( this.childA.element );
     * 		this.element.appendChild( this.childB.element );
     * 	}
     * }
     *
     * const view = new SampleView( locale );
     *
     * view.render();
     *
     * // Will append <p><childA#element><b></b><childB#element></p>.
     * document.body.appendChild( view.element );
     * ```
     *
     * **Note**: There's no need to add child views if they're already referenced in the
     * {@link #template}:
     *
     * ```ts
     * class SampleView extends View {
     * 	constructor( locale ) {
     * 		super( locale );
     *
     * 		this.childA = new SomeChildView( locale );
     * 		this.childB = new SomeChildView( locale );
     *
     * 		this.setTemplate( {
     * 			tag: 'p',
     *
     * 			// These children will be added automatically. There's no
     * 			// need to call {@link #registerChild} for any of them.
     * 			children: [ this.childA, this.childB ]
     * 		} );
     * 	}
     *
     * 	// ...
     * }
     * ```
     *
     * @param children Children views to be registered.
     */
    registerChild(children) {
        if (!isIterable(children)) {
            children = [children];
        }
        for (const child of children) {
            this._unboundChildren.add(child);
        }
    }
    /**
     * The opposite of {@link #registerChild}. Removes a child view from this view instance.
     * Once removed, the child is no longer managed by its parent, e.g. it can safely
     * become a child of another parent view.
     *
     * @see #registerChild
     * @param children Child views to be removed.
     */
    deregisterChild(children) {
        if (!isIterable(children)) {
            children = [children];
        }
        for (const child of children) {
            this._unboundChildren.remove(child);
        }
    }
    /**
     * Sets the {@link #template} of the view with with given definition.
     *
     * A shorthand for:
     *
     * ```ts
     * view.setTemplate( definition );
     * ```
     *
     * @param definition Definition of view's template.
     */
    setTemplate(definition) {
        this.template = new Template(definition);
    }
    /**
     * {@link module:ui/template~Template.extend Extends} the {@link #template} of the view with
     * with given definition.
     *
     * A shorthand for:
     *
     * ```ts
     * Template.extend( view.template, definition );
     * ```
     *
     * **Note**: Is requires the {@link #template} to be already set. See {@link #setTemplate}.
     *
     * @param definition Definition which extends the {@link #template}.
     */
    extendTemplate(definition) {
        Template.extend(this.template, definition);
    }
    /**
     * Recursively renders the view.
     *
     * Once the view is rendered:
     * * the {@link #element} becomes an HTML element out of {@link #template},
     * * the {@link #isRendered} flag is set `true`.
     *
     * **Note**: The children of the view:
     * * defined directly in the {@link #template}
     * * residing in collections created by the {@link #createCollection} method,
     * * and added by {@link #registerChild}
     * are also rendered in the process.
     *
     * In general, `render()` method is the right place to keep the code which refers to the
     * {@link #element} and should be executed at the very beginning of the view's life cycle.
     *
     * It is possible to {@link module:ui/template~Template.extend} the {@link #template} before
     * the view is rendered. To allow an early customization of the view (e.g. by its parent),
     * such references should be done in `render()`.
     *
     * ```ts
     * class SampleView extends View {
     * 	constructor() {
     * 		this.setTemplate( {
     * 			// ...
     * 		} );
     * 	},
     *
     * 	render() {
     * 		// View#element becomes available.
     * 		super.render();
     *
     * 		// The "scroll" listener depends on #element.
     * 		this.listenTo( window, 'scroll', () => {
     * 			// A reference to #element would render the #template and make it non-extendable.
     * 			if ( window.scrollY > 0 ) {
     * 				this.element.scrollLeft = 100;
     * 			} else {
     * 				this.element.scrollLeft = 0;
     * 			}
     * 		} );
     * 	}
     * }
     *
     * const view = new SampleView();
     *
     * // Let's customize the view before it gets rendered.
     * view.extendTemplate( {
     * 	attributes: {
     * 		class: [
     * 			'additional-class'
     * 		]
     * 	}
     * } );
     *
     * // Late rendering allows customization of the view.
     * view.render();
     * ```
     */
    render() {
        if (this.isRendered) {
            /**
             * This View has already been rendered.
             *
             * @error ui-view-render-already-rendered
             */
            throw new CKEditorError('ui-view-render-already-rendered', this);
        }
        // Render #element of the view.
        if (this.template) {
            this.element = this.template.render();
            // Auto–register view children from #template.
            this.registerChild(this.template.getViews());
        }
        this.isRendered = true;
    }
    /**
     * Recursively destroys the view instance and child views added by {@link #registerChild} and
     * residing in collections created by the {@link #createCollection}.
     *
     * Destruction disables all event listeners:
     * * created on the view, e.g. `view.on( 'event', () => {} )`,
     * * defined in the {@link #template} for DOM events.
     */
    destroy() {
        this.stopListening();
        this._viewCollections.map(c => c.destroy());
        // Template isn't obligatory for views.
        if (this.template && this.template._revertData) {
            this.template.revert(this.element);
        }
    }
}
