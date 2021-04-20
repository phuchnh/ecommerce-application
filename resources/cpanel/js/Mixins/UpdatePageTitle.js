export default {
  mounted() {
    document.title = this.$page.props.cpanel.title || 'Cpanel';
  },
};
