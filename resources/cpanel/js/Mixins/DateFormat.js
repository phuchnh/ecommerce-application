import moment from 'moment';
export default {
  filters: {
    dateFormat: function (date, format = 'YYYY-MM-DD') {
      if (!date) return '';
      return moment(date).format(format);
    },
  },
};
