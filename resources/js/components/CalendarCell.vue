<template>
    <div class="cursor-pointer">
        <div @click="open">
            {{ day }}
        </div>
        <reserve-modal v-if="modal" @close="close" :year="year" :month="month" :day="day"/>
    </div>
</template>
<script>
import ReserveModal from './ReserveModal'
export default {
    components: {
        ReserveModal,
    },

    props: [ 'year', 'month', 'day' ],

    data () {
        return {
            modal: false,
        }
    },

    methods: {
        open() {
            this.modal = true
        },

        close() {
            this.modal = false
        },

    }

}
</script>