<template>
<transition name="modal" appear>
   <div class="fixed w-full h-full top-0 left-0 z-30 flex items-center justify-center bg-black bg-opacity-30"
     @click.self="$emit('close')">
        <div class="overflow-hidden w-4/5 bg-white rounded-sm sm:w-1/3">
            <div class="p-4 bg-gray-200">
                {{ year }}年{{ month }}月{{ day }}日
            </div>
            <div class="px-4 py-8">
                <div>
                    <input type="checkbox" id="first" value="1" v-model="schedule">
                    <label for="first">10:00〜10:50</label>
                </div>
                <div>
                    <input type="checkbox" id="second" value="2" v-model="schedule">
                    <label for="second">11:00〜11:50</label>
                </div>
                <div>
                    <input type="checkbox" id="third" value="3" v-model="schedule">
                    <label for="third">12:00〜12:50</label>
                </div>
                <div>
                    <input type="checkbox" id="forth" value="4" v-model="schedule">
                    <label for="forth">14:00〜14:50</label>
                </div>
            </div>
            <div class="p-4 bg-gray-200">
                <button @click="$emit('close')">戻る</button>
                <button @click="submit">確定</button>
            </div>
        </div>
    </div>
</transition>
</template>
<script>

export default {

    props: [ 'year', 'month', 'day' ],

    async created() {
        if(!this.day){
            return
        }
        await axios.get('/api/reserve', {
            params: {
                year: this.year,
                month: this.month,
                day: this.day,
            }
        })
        .then(response => {
            this.schedule = response.data.class
        })
    },

    data(){
        return {
            schedule: [],
        }
    },

    methods: {
        async submit() {

            let data = {
                'year'      : this.year,
                'month'     : this.month,
                'day'       : this.day,
                'schedule'  : this.schedule,
            }

            await axios.post('/api/reserve', data)
                .then(response => {
                    alert('予約を完了しました')
                    this.$emit('close')
                })
                .catch(error => {
                    alert('エラーが発生しました')
                    this.close()
                })

        }
    }

}

</script>

<style scoped>
.modal-enter-active {
  transition: opacity 0.3s;
}

.modal-leave-active {
  transition: opacity 0.4s ease 0.2s;
}

.modal-enter, .modal-leave-to {
  opacity: 0;
}

</style>