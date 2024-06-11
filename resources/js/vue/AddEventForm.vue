<template>
    <v-sheet>
        <v-form @submit.prevent="addEvent">
            <v-text-field 
                name="name" 
                v-model="event.name" 
                label="Название мероприятия" 
                :rules="[v => !!v || 'Поле обязательно.']" 
                required
            />
            <v-text-field 
                name="location" 
                v-model="event.location" 
                label="Место проведения" 
                :rules="[v => !!v || 'Поле обязательно.']" 
                required
            />
            <v-text-field 
                type="datetime-local" 
                name="datetime" 
                v-model="event.datetime" 
                :rules="[v => !!v || 'Поле обязательно.']"
                required
            />
            <v-textarea 
                name="note" 
                v-model="event.note" 
                label="Заметки..."
            />
            <v-btn class="w-100" type="submit">Добавить</v-btn>
        </v-form>
    </v-sheet>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            requiredRules: [
                value => {
                    if (value) return;

                    return 'Обязательно для заполнения.'
                }
            ],
            event: {
                name: "",
                location: '',
                datetime: null,
                note: '',
                user: '',
            }
        }
    },
    mounted() {
        this.event.user = this.userId
    },
    props: ['userId'],
    methods: {
        addEvent() {
            if (this.event.name == '') {
                return;
            }

            axios.post('api/event/store', {
                event: this.event
            })
                .then(response => {
                    if (response.status == 201) {
                        this.event.name = "";
                        this.event.note = "";
                        this.event.datetime = null;
                        this.event.location = "";
                        this.event.user = '';

                        this.$emit('reloadlist');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style scoped>
.addEvent {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    align-items: center;
    flex-wrap: wrap;
}

.plus {
    font-size: 20px;
    width: 100%;
}

.active {
    color: #00CE25;
}

.inactive {
    color: #999999;
}
</style>