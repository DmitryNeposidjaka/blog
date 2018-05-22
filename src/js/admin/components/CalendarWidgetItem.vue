<template>
    <li
        :data-weekday="day.format('dd')" :data-week="day.isoWeek()">
        <span class="calendar-day__number">{{ day.format('DD') }}</span>
        <div class="calendar-day__content"><div class="calendar-widget-item-content"><slot name="content"></slot></div></div>
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
.calendar-widget-item-content{
    width: 100%;
    height: 100%;
    position: absolute;
    padding: 25px 5px 5px 5px;
}
</style>