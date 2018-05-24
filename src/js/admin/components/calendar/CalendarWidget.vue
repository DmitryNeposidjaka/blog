<template>
    <ol class="calendar">
        <calendar-widget-item v-for="(day, k) in days"
         :class="[
             cl.day,
             isToday(day, $moment(today))? cl.today : '',
             isEntry(day, $moment(selected))? cl.dayEntry : '',
             cl.beginWeek,
             cl.dayPast,
             inMonth(day, $moment(selected))? '': cl.notMonth
         ]"
        :day="day" :key="k">
            <div slot="content" style="color: #fff">
               <div v-if="getADayTasks(day).length > 0">
                   задач: {{ getADayTasks(day).length}}
               </div>
            </div>
        </calendar-widget-item>
    </ol>
</template>

<script>
    import CalendarWidgetItem from './CalendarWidgetItem'
  export default {
    props: ['day', 'tasks'],
    data(){
      return{
        cl: {
          day: 'calendar-day',
          beginWeek: 'calendar-day--begin-week',
          dayPast: 'calendar-day--past',
          notMonth: 'calendar-day--not-month',
          dayEntry: 'calendar-day--entry',
          today: 'calendar-day--today',
        },
      }
    },
    computed: {
      today(){
        return this.$moment()
      },
      selected(){
        if(this.day !== null){
          return this.day;
        } else {
          return this.$moment()
        }
      },
      days(){
        const today = this.$moment(this.selected);
        const startMonth = this.$moment(today).startOf('month');
        const endMonth = this.$moment(today).endOf('month');
        const start = startMonth.weekday(1);
        const end = endMonth.weekday(7);
        return this._getDatesBetween(start, end);
      }
    },
    methods: {
      getADayTasks(day){
        const vm = this;
        return this.tasks.filter(function (item, i, arr) {
          return vm.$moment(item.assigned_at).isSame(day, 'day');
        });
      },
      isToday(day, today){
        return day.startOf('date').diff(today.startOf('date')) == 0;
      },
      isEntry(day, selected){
        return day.startOf('date').diff(selected.startOf('date')) == 0;
      },
      inMonth(day, month){
        return day >= month.startOf('month') && day <= month.endOf('month')
      },
      _getDatesBetween(startDate, endDate){
        console.log([startDate, endDate])
        const dates = [];
        let currentDate = startDate.clone();
        while (currentDate <= endDate) {
          dates.push(currentDate.clone());
          currentDate.add(1, 'day');
        }
        return dates;
      },
    },
    components: {CalendarWidgetItem},
    created(){}
  }
</script>

<style>
    .calendar {
        margin: 4rem 0rem 4rem 2rem;
        padding: 0;
        list-style: none;
        font-size: 1rem;
    }

    .calendar-day {
        color: #607d8b;
        position: relative;
        box-sizing: border-box;
    }

    .calendar-day:nth-child(7n+1)::before {
        content: attr(data-week);
        position: absolute;
        color: #999;
    }

    .calendar-day::after {
        content: attr(data-weekday);
        position: absolute;
        color: #999;
    }

    .calendar-day__content {
        background: #CCEFF6;
    }

    .calendar-day__content:hover {
        background: #CCEFF6;
        box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    }

    .calendar-day--not-month .calendar-day__content {
        opacity: .5;
    }

    .calendar-day--today .calendar-day__content {
        background-color: #a7f3b7;
    }

    .calendar-day--entry .calendar-day__content {
        background-color: #FFB7AF;
    }

    .calendar-day__number {
        color: black;
        position: absolute;
        top: .5rem;
        left: .5rem;
    }

    @media screen and (max-width: 40rem) {
        .calendar-day {
            margin: 0 0 2px;
        }

        .calendar-day:nth-child(7n+1)::before {
            left: 0;
            right: 0;
            bottom: calc(100% + .5rem);
            display: block;
            text-align: center;
        }

        .calendar-day::after {
            right: calc(100% + .5rem);
            top: .5rem;
        }

        .calendar-day--not-month {
            display: none;
        }

        .calendar-day--begin-week {
            margin-top: 3rem;
        }

        .calendar-day__content {
            padding: 0 0 20%;
        }
    }

    @media screen and (min-width: 40rem) {
        .calendar {
            display: flex;
            flex-wrap: wrap;
        }

        .calendar-day {
            flex-basis: calc(14.28571% - 2px);
            margin: 1px;
        }

        .calendar-day:nth-child(7n+1)::before {
            right: calc(100% + .5rem);
            top: .5rem;
        }

        .calendar-day::after {
            display: none;
        }

        .calendar-day:nth-child(-n+7)::after {
            display: inline;
            bottom: calc(100% + .2rem);
            left: .5rem;
        }

        .calendar-day--not-month {
            display: block;
        }

        .calendar-day--past .calendar-day__number {
            opacity: .5;
        }

        .calendar-day__content {
            padding-bottom: 100%;
        }
    }

</style>