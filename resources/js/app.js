require('./bootstrap');

import Vue from 'vue'
import CalendarCell from './components/CalendarCell'
import ReserveModal from './components/ReserveModal'

const app = new Vue({
  el: '#app',
  components: {
      CalendarCell,
  }
})
