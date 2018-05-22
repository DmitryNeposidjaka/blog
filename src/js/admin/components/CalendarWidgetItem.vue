<template>
    <li
        :data-weekday="day.format('dd')" :data-week="day.isoWeek()">
        <span class="calendar-day__number">{{ day.format('DD') }}</span>
        <div class="calendar-day__content"><slot name="content"></slot></div>
    </li>
</template>

<script>
    export default {
      props: ['day'],
      data(){
        return {

        }
      }
    }
</script>

<style>

</style>