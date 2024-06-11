<template>
    <v-card class="item" style="padding: 24px">
        <div :class="[event.completed ? 'completed' : '', 'itemText']">Название мероприятия: {{ event.name }}</div>
        <div>
            Место проведения: {{ event.location }}
        </div>
        <div>
            Дата и время проведения: {{ event.datetime }}
        </div>
        <div>Заметка: {{ event.note ? event.note : 'пусто.' }}</div>
        <div>
            <button @click="removeItem()" class="trashcan">
                Удалить
            </button>
            <label :style="{ color: event.completed ? 'lightgrey' : '' }">
                <input type="checkbox" @input="updateCheck()" ref="completed" 
                    :checked="event.completed == 1 ? true : false" :disabled="event.completed == 1 ? true : false" name="completed" />
                Завершено
            </label>
            <div v-if="event.completed">Дата и время завершения: {{ event.completed_at }}</div>
        </div>
    </v-card>
</template>

<script>
import axios from 'axios';

export default {
    props: ['event'],
    methods: {
        updateCheck() {
            const completed = this.$refs.completed.checked;
            this.event.completed = completed == true ? 1 : 0;
            axios.put('api/event/' + this.event.id, {
                event: this.event
            })
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('eventchanged');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        removeItem() {
            axios.delete('api/event/' + this.event.id)
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('eventchanged');
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        },
    }
}
</script>

<style>
div {
    width: 100%;
}

.completed {
    text-decoration: line-through;
    color: #999999;
}

.item {
    align-items: center;
    display: flex;
    flex-direction: column;
    padding: 24px;
    background: #e6e6e6;
}

/* .item:not(:first-child) {
    background: red;
} */

.trashcan {
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
}

button {
    padding: 1.5%;
    margin-right: 3%;
    border-radius: 15px;
}
</style>