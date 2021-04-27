export default {
  filters: {
    preview: function (file) {
      if (!file) return '';
      return URL.createObjectURL(file);
    },
  },
};
