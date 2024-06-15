<template>
    <v-card class="container">
        <v-tabs v-model="tab" bg-color="primary">
            <v-tab value="home">Главная</v-tab>
            <v-tab value="history">История</v-tab>
        </v-tabs>

        <div class="bodyng">
            <v-window v-model="tab">
                <v-window-item value="home" key="home">
                    <div class="heading">
                        <h2 id="title" class="mb-8">Главная</h2>
                        <add-event-form :user-id="this.userId" v-on:reloadlist="getList()" />
                    </div>
                    <list-view :events="events" mode="active" v-on:reloadlist="getList()" />
                </v-window-item>

                <v-window-item value="history" key="history">
                    <h2 id="title" class="mb-8">История</h2>
                    <list-view :events="events" v-on:reloadlist="getList()" />
                </v-window-item>
            </v-window>
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
            axios.post('api/events', {
                userId: this.userId,
            })
                .then(response => {
                    this.events = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    watch: {
        tab() {
            this.getList();
        }
    },
    created() {
        this.userId = document.getElementById('user').dataset.userId;

        this.getList();
    },
    data() {
        return {
            events: [],
            tab: 'home',
            userId: '',
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