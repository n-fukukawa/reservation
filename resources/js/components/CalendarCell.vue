<template>
<div>
    <div @click="open" class="h-20 px-1 cursor-pointer border border-gray-500 hover:bg-gray-100">
        <div>
            <p class="text-lg" :class="{'text-blue-400': number % 7 === 6, 'text-red-500' : number % 7 === 0 }">{{ day }}</p>
            <div class="flex flex-col space-y-1">
                <span v-for="(clazz, i) in classes" :key="i" class="text-xs rounded" :class="{'bg-blue-200' : clazz <= 3, 'bg-yellow-200' : clazz >=4}">{{ times[clazz] }}</span>
            </div>
        </div>
    </div>

    <my-modal v-if="modal" @close="close">
        <template #header>                
            {{ year }}年{{ month }}月{{ day }}日
        </template>
        <div class="px-4 py-8">
            <div>
                <input type="checkbox" id="first" value="1" v-model="classes" @change="submit">
                <label for="first">{{ times[1] }}</label>
            </div>
            <div>
                <input type="checkbox" id="second" value="2" v-model="classes" @change="submit">
                <label for="second">{{ times[2] }}</label>
            </div>
            <div>
                <input type="checkbox" id="third" value="3" v-model="classes" @change="submit">
                <label for="third">{{ times[3] }}</label>
            </div>
            <div>
                <input type="checkbox" id="forth" value="4" v-model="classes" @change="submit">
                <label for="forth">{{ times[4] }}</label>
            </div>
            <div>
                <input type="checkbox" id="fifth" value="5" v-model="classes" @change="submit">
                <label for="fifth">{{ times[5] }}</label>
            </div>
            <div>
                <input type="checkbox" id="sixth" value="6" v-model="classes" @change="submit">
                <label for="sixth">{{ times[6] }}</label>
            </div>
        </div>
        <template #footer>
            <button @click="close" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">閉じる</button>
        </template>
    </my-modal>

</div>
</template>

<script>
import MyModal from './MyModal'
export default {
    components: {
        MyModal,
    },

    props: [ 'year', 'month', 'day', 'reservation', 'number' ],

    data () {
        return {
            modal: false,
            classes: this.reservation,
            times: {
                1: '10:00〜10:50',
                2: '11:00〜11:50',
                3: '12:00〜12:50',
                4: '14:00〜14:50',
                5: '15:00〜15:50',
                6: '16:00〜16:50',
            }
        }
    },

    methods: {
        open() {
            if(this.day === ''){ return }
            this.modal = true
        },

        close() {
            this.modal = false
        },

        async submit() {

            let data = {
                'year'      : this.year,
                'month'     : this.month,
                'day'       : this.day,
                'classes'  : this.classes,
            }

            await axios.post('/api/reserve', data)
                .then(response => {
                    this.classes = response.data.classes
                })
                .catch(error => {
                    alert('エラーが発生しました')
                    this.close()
                })

        }
    }

}
</script>