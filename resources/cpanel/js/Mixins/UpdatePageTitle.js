export default {
  created() {
    document.title = 'Laravel - ' + this.$page.props?.cpanel.title;
  },
};
