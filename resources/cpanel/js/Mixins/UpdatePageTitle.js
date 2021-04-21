export default {
  mounted() {
    document.title = 'Laravel - ' + this.$page.props?.cpanel.title;
  },
};
