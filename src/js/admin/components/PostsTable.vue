<template>
    <el-row>
        <el-date-picker
                v-model="range"
                type="daterange"
                range-separator="To"
                start-placeholder="Start date"
                end-placeholder="End date"
                :default-time="[$moment().startOf('month'), $moment()]">
        </el-date-picker>
        <el-table
                :data="dataFiltered"
                style="width: 100%">
            <el-table-column
                    prop="created_at"
                    label="Дата"
                    width="180"
                    sortable>
                <template slot-scope="scope">
                    <span style="color: #909399">{{scope.row.created_at}}</span>
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
            <el-table-column
                    prop="disabled"
                    label="Аут"
                    sortable>
                <template slot-scope="scope">
                    <el-tag
                            :type="scope.row.disabled ? 'info' : 'success'"
                            close-transition>{{scope.row.disabled? 'удален': 'активный'}}</el-tag>
                </template>
            </el-table-column>
            <el-table-column
                    label="Операции">
                <template slot-scope="scope">
                    <post-operations :model="scope.row"></post-operations>
                </template>
            </el-table-column>
        </el-table>
    </el-row>
</template>

<script>
    import PostOperations from './PostOperations';

  export default {
    props: ['models'],
    data(){
      return{
        range: '',
      };
    },
    computed: {
      dataFiltered(){
        const vm = this;
        let models = this.models;
        models = this.models.filter(function (item, i, arr ) {
          const from = vm.$moment(vm.range[0]);
          const to = vm.$moment(vm.range[1]);
          const date = vm.$moment(item.created_at);
        });
        return models
      },
      _dateFilter(models, range){
        return models.filter(function (item, i, arr ) {
          const from = vm.$moment(range[0]);
          const to = vm.$moment(range[1]);
          const date = vm.$moment(item.created_at);
        });
      }
    },
    methods:{
      filterHandler(value, row, column) {
        console.log({value, row, column});
      }
    },
    components: {PostOperations}

  }
</script>

<style>

</style>