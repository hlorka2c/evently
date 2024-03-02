<template>
    <div class="item">
        <input :disabled="event.completed" type="checkbox" @change="updateCheck()" v-model="event.completed"
            :checked="event.completed" />
        <span :class="[event.completed ? 'completed' : '', 'itemText']">{{ event.name }}</span>
        <button @click="removeItem()" class="trashcan">
            <font-awesome-icon icon="trash" />
        </button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['event'],
    methods: {
        updateCheck() {
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
.completed {
    text-decoration: line-through;
    color: #999999;
}

.itemText {
    width: 100%;
    margin-left: 20px;
}

.item {
    display: flex;
    justify-content: center;
}

.trashcan {
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
}
</style>