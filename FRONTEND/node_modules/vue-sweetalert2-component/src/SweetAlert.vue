<template>
  <div></div>
</template>
<script>
const getSwal = () => require('sweetalert2')
export default {
  name: 'SweetAlert',
  props: {
    alert: {
      type: Object,
      required: true
    },
    display: {
      type: Boolean,
      required: true
    }
  },
  watch: {
    display(val) {
      if(!val) {
        this.swal.close()
      } else {
        this.swal(this.alert)
          .then(
            value => this.$emit('resolve', value),
            reason => this.$emit('reject', reason)
          )
      }
    }
  },
  mounted() {
    this.swal = getSwal()
  }
}
</script>