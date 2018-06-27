<template>
    <el-row>
        <el-row :gutter="5">
            <el-col :span="4">
                <el-checkbox v-model="filters.unlimited" label="бессрочные" border></el-checkbox>
            </el-col>
            <el-col :span="6">
                <el-date-picker
                        v-model="filters.range"
                        type="daterange"
                        range-separator="To"
                        start-placeholder="Start date"
                        end-placeholder="End date"
                        :disabled="filters.unlimited">
                </el-date-picker>
            </el-col>
            <el-col :span="8">
                <el-input v-model="filters.title"></el-input>
            </el-col>
            <el-col :span="6">
                <el-radio-group v-model="filters.close">
                    <el-radio-button :label="null">Все</el-radio-button>
                    <el-radio-button :label="false">Открытые</el-radio-button>
                    <el-radio-button :label="true">Закрытые</el-radio-button>
                </el-radio-group>
            </el-col>

        </el-row>
        <el-table
                :data="dataFiltered"
                style="width: 100%">
            <el-table-column
                    prop="assigned_at"
                    label="Назначен на"
                    width="180"
                    sortable>
                <template slot-scope="scope">
                    <span v-if="!scope.row.unlimited" style="color: #909399">{{scope.row.assigned_at}}</span>
                    <span v-else style="color: #909399">бессрочная</span>
                </template>
            </el-table-column>
            <el-table-column
                    prop="title"
                    label="Название"
                    width="400">
                <template slot-scope="scope">
                    <span style="color: #3a8ee6">{{scope.row.title}}</span>
                </template>
            </el-table-column>
<!--            <el-table-column
                    prop="important"
                    label="F Аут"
                    sortable>
                <template slot-scope="scope">
                    <el-tag
                            :type="scope.row.disabled ? 'info' : 'success'"
                            close-transition>{{scope.row.disabled? 'удален': 'активный'}}</el-tag>
                </template>
            </el-table-column>-->
            <el-table-column
                    prop="disabled"
                    label="Приоритет"
                    sortable>
                <template slot-scope="scope">
                    <el-tag
                            :type="getPriority(scope.row.important).type"
                            close-transition>{{getPriority(scope.row.important).name}}</el-tag>
                </template>
            </el-table-column>
            <el-table-column
                    label="Операции">
                <template slot-scope="scope">
                    <table-task-operations :item="scope.row"></table-task-operations>
                </template>
            </el-table-column>
        </el-table>
    </el-row>
</template>

<script>
  import TableTaskOperations from './TableTaskOperations';

  export default {
    props: ['models'],
    data(){
      const vm = this;
      return{
        filters:{
          range: [
            vm.$moment().startOf('month')._d,
            vm.$moment()._d
          ],
          title: '',
          close: null,
          unlimited: false
        },
        priority: [
          {id: 'MAX', name: 'важно', type: 'danger'},
          {id: 'MIDDLE', name: 'нормально', type: 'primary'},
          {id: 'MIN', name: 'мин', type: 'success'},
        ]

      };
    },
    computed: {
      dataFiltered(){
        const vm = this;
        let models = this.models;
        /*models = this._dateFilter(models, vm.filters.range)*/
        models = this._titleFilter(models, vm.filters.title)
        models = this._closeFilter(models, vm.filters.close)
        models = this._importantFilter(models, vm.filters.important)
        models = this._unlimitedFilter(models, vm.filters.unlimited)

        return models
      },
    },
    methods:{
      getPriority(id){
        return this.priority.find(x => id == x.id)
      },
      _importantSort(data){
        return data.sort(function (a1, b1) {
          const a = a1.important, b = b1.important;
          if(a == 'MAX' &&  b == 'MIDDLE')  return      -1
          if(a == 'MAX' && b == 'MIN')      return      -1
          if(a == 'MIDDLE' &&  b == 'MIN')  return      -1
          if(a == 'MIDDLE' &&  b == 'MAX')  return      1
          if(a == 'MIN' &&  b == 'MIDDLE')  return      1
          if(a == 'MIN' && b == 'MAX')      return      1

          if(a == b) return 0
          return -1
        });
      },
      _dateFilter(models, range){
        const vm = this;
        return models.filter(function (item, i, arr ) {
          const from = vm.$moment(range[0]);
          const to = vm.$moment(range[1]);
          const date = vm.$moment(item.created_at);
          return date >= from && date <= to;
        });
      },
      _titleFilter(models, title){
        if (title.length > 0){
          return models.filter(function (item, i, arr ) {
            return item.title.search(title) >= 0;
          });
        } else {
          return models;
        }
      },
      _importantFilter(models, type){
        if(type != null){
          return models.filter(function (item, i, arr) {
            return item.important == type;
          })
        }else {
          return models;
        }
      },
      _closeFilter(models, type){
        if(type != null){
          return models.filter(function (item, i, arr) {
            return item.close == type;
          })
        }else {
          return models;
        }
      },
      _unlimitedFilter(models, type){
        if(type != false){
          return models.filter(function (item, i, arr) {
            return item.unlimited == type;
          })
        }else {
          return models;
        }
      }
      /*      filterHandler(value, row, column) {
              console.log({value, row, column});
            }*/
    },
    components: {TableTaskOperations}

  }
</script>

<style>

</style>