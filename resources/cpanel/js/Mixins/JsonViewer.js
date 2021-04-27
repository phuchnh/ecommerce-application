export default {
  filters: {
    json: function (value) {
      if (!value) return '';
      return JSON.stringify(value, null, 2);
    },
  },
};
