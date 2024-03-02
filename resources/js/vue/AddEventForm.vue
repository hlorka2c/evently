<template>
    <div class="addEvent">
        <input type="text" name="name" class="name" v-model="event.name" />
        <font-awesome-icon @click="addEvent()" icon="plus-square"
            :class="[event.name ? 'active' : 'inactive', 'plus']" />
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            event: {
                name: "",
            }
        }
    },

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

<style>
.addEvent {
    display: flex;
    justify-content: center;
    align-items: center;
}

.plus {
    font-size: 20px;
}

.active {
    color: #00CE25;
}

.inactive {
    color: #999999;
}

input {
    background-color: #f7f7f7;
    border: none;
    outline: none;
    padding: 5px;
    margin-right: 10px;
}

.name {
    width: 100%;
}
</style>