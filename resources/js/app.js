require('./bootstrap');

import Vue from 'vue'
import CalendarCell from './components/CalendarCell'

const app = new Vue({
  el: '#app',
  components: {
      CalendarCell,
  }
})
