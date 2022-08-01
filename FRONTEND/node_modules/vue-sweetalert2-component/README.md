# vue-sweetalert2-component

A Vue component that wraps [SweetAlert2](https://limonte.github.io/sweetalert2/).

Instead of attempting to emulate all the cool SweetAlert2 options, it only display or hides the alert, using a single prop object `:alert` to accomplish everything SweetAlert2 can do.

## Installation

```js
npm i --save vue-sweetalert2-component
```

Note that you will need to 
1. install the sweetalert2 dependency; 
1. include the sweetalert2 CSS in your page ([CDN](https://cdnjs.com/libraries/limonte-sweetalert2), webpack or other means)

### Module

```js
import SweetAlert from 'vue-sweetalert2-component';
```

### Browser

Include the script file, then install the component with `Vue.use(VueSweetAlert2);` e.g.:

```html
<script type="text/javascript" src="node_modules/vuejs/dist/vue.min.js"></script>
<script type="text/javascript" src="node_modules/vue-sweetalert2-component/dist/vue-sweetalert2-component.min.js"></script>
<script type="text/javascript">
  Vue.use(VueSweetAlert2);
</script>
```

## Usage

Once installed, it can be used in a template as simply as:

```html
<template>
  <sweet-alert :display="displayProp" :alert="alertObject"></sweet-alert>
</template>

<script>
  import SweetAlert from 'vue-sweetalert2-component'
  export default {
    components: {
      SweetAlert
    },
    data() {
      return {
        displayProp: false,
        alertObject: {
          title: '<i>HTML</i> <u>example</u>',
          type: 'info',
          html:
            'You can use <b>bold text</b>, ' +
            'and other HTML tags',
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
          confirmButtonText:
            'Great!',
          confirmButtonAriaLabel: 'Thumbs up, great!',
          cancelButtonText:
          'Nope',
          cancelButtonAriaLabel: 'Thumbs down',
        }
      }
    },
    mounted() {
      setTimeout(() => this.displayProp = true, 2000)
    }
  }
</script>
```

For examples of values of the `alertObject`, please see [SweetAlert2](https://limonte.github.io/sweetalert2/)

Note that `alertObject` isn't watched, so changes on it will not "rerender" the alert. You'll need to toggle `displayProp` if you wish to rerender the alert.

### Props

`:display` and `:alert` are required properties.  
- `display` is a boolean which represents whether to display the alert.  
- `alert` is an object as used in the vanilla [SweetAlert2](https://limonte.github.io/sweetalert2/)

There are no other properties. Everything goes through the object bound to `:alert`.

### Events

SweetAlert2 returns a promise. Therefore the 2 events available on the component are `@resolve` and `@reject`. They are triggered as expected when the SweetAlert promise resolves or rejects; resolution value or rejection reason are exactly the same as those passed by the vanilla SweetAlert promise.