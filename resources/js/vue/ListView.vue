<template>
    <div>
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

<style scoped>
.item {
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>