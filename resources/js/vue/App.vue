<template>
    <div class="eventListContainer">
        <div class="heading">
            <h2 id="title">Event List</h2>
            <add-event-form v-on:reloadlist="getList()"/>
        </div>

        <list-view :events="events" v-on:reloadlist="getList()"/>
    </div>
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
.eventListContainer {
    width: 100%;
    max-width: 600px;
    margin: auto;
}

.heading {
    background: #e6e6e6;
    padding: 10px;
}

#title {
    text-align: center;
}
</style>

