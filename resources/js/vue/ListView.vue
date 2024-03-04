<template>
    <div class="items-container">
        <div v-for="(event, index) in events" :key="index">
            <list-item :event="event" v-on:eventchanged="$emit('reloadlist')"/>
        </div>
    </div>
</template>

<script>
import ListItem from './ListItem.vue';
export default {
    components: {
        ListItem
    },
    props: ['events'],
}
</script>

<style>
.items-container {
    display: flex;
    flex-direction: column;
    gap: 16px;
}
</style>