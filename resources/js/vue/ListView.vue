<template>
    <div class="items-container" v-if="events.length">
        <div v-for="(event, index) in events" :key="index">
            <list-item :event="event" v-on:eventchanged="$emit('reloadlist')"
                v-if="mode === 'active' && !event.completed" />
            <list-item :event="event" v-on:eventchanged="$emit('reloadlist')"
                v-else-if="mode !== 'active' && event.completed" />
        </div>
    </div>
</template>

<script>
import ListItem from './ListItem.vue';
export default {
    components: {
        ListItem
    },
    emits: ['reloadlist'],
    props: ['events', 'mode'],
    data() {
        return {
            activeEvents: [],
            inactiveEvents: []
        }
    },
    methods: {
        sortEvents() {
            this.activeEvents = this.events.filter(function (el) {
                return el.completed
            });
            this.inactiveEvents = this.events.filter(function (el) {
                return el.completed
            });
        }
    },
    created() {
        this.sortEvents()
    }
}
</script>

<style>
.items-container {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
</style>