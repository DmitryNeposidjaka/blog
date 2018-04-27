<template>
    <el-row>
        <el-row :gutter="10">
            <el-col :span="8">
                <el-date-picker
                        v-model="filters.range"
                        type="daterange"
                        range-separator="To"
                        start-placeholder="Start date"
                        end-placeholder="End date">
                </el-date-picker>
            </el-col>
            <el-col :span="8">
                <el-input v-model="filters.title"></el-input>
            </el-col>
            <el-col :span="8">
                <el-radio-group v-model="filters.disabled">
                    <el-radio-button :label="null">Все</el-radio-button>
                    <el-radio-button :label="false">Актив</el-radio-button>
                    <el-radio-button :label="true">Удал</el-radio-button>
                </el-radio-group>
            </el-col>
        </el-row>
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
    props: ['models', 'categories'],
    data(){
      const vm = this;
      return{
        filters:{
          range: [
            vm.$moment().startOf('month')._d,
            vm.$moment()._d
          ],
          title: '',
          disabled: null
        },

      };
    },
    computed: {
      dataFiltered(){
        const vm = this;
        let models = this.models;
        models = this._dateFilter(models, vm.filters.range)
        models = this._titleFilter(models, vm.filters.title)
        models = this._disabledFilter(models, vm.filters.disabled)

        return models
      },

    },
    methods:{
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
      _disabledFilter(models, type){
        if(type != null){
          return models.filter(function (item, i, arr) {
            return item.disabled == type;
          })
        }else {
          return models;
        }

      }
/*      filterHandler(value, row, column) {
        console.log({value, row, column});
      }*/
    },
    components: {PostOperations}

  }
</script>

<style>

</style>