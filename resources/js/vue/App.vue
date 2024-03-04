<template>
    <v-card class="container">
        <div class="heading">
            <h2 id="title" class="mb-8">Evently</h2>
            <add-event-form v-on:reloadlist="getList()"/>
        </div>

        <div class="bodyng">
            <list-view :events="events" v-on:reloadlist="getList()"/>
        </div>
    </v-card>
</template>

<script>
import axios from 'axios';
import AddEventForm from './AddEventForm';
import ListView from './ListView';

export default {
    components: {
        AddEventForm,
        ListView
    },
    methods: {
        getList() {
            axios.get('api/events')
                .then(response => {
                    this.events = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    created() {
        this.getList();
    },
    data() {
        return {
            events: [],
        }
    },
}
</script>

<style scoped>
.container {
    width: 100%;
    max-width: 600px;
    margin: auto;
}

.heading {
    background: #e6e6e6;
    padding: 10px;
}

.bodyng {
    margin-top: 16px;
    background: #e6e6e6;
    padding: 10px;
}

#title {
    text-align: center;
}
</style>

