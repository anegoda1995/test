<template>
    <div class="ui container">
        <filter-bar></filter-bar>
        <!-- <button class="ui basic button" @click="actionCreate(rowData, rowIndex)">Create new employee</button> -->
        <vuetable ref="vuetable"
            api-url="api/employee"
            :fields="fields"
            :http-options="httpOptions"
            pagination-path=""
            @vuetable:pagination-data="onPaginationData"
            :append-params="moreParams"
        ></vuetable>
        <vuetable-pagination ref="pagination"
            @vuetable-pagination:change-page="onChangePage"
        >
        </vuetable-pagination>
    </div>
</template>

<script>
import Vue from 'vue';
import CustomActions from './CustomActions'
Vue.component('custom-actions', CustomActions)
import Vuetable from 'vuetable-2/src/components/Vuetable';
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination';

export default {
  components: {
    Vuetable,
    VuetablePagination,
    CustomActions
  },
  data () {
    return {
      httpOptions: { headers: { Authorization: 'Bearer ' + localStorage.getItem('default_auth_token') } },
      fields: [
        {
          name: 'id',
          sortField: 'id',
          title: 'ID'
        },
        {
          name: 'first_name',
          sortField: 'first_name',
          title: 'First name'
        },
        {
          name: 'middle_name',
          sortField: 'middle_name',
          title: 'Middle name',
        },
        {
          name: 'last_name',
          sortField: 'last_name',
          title: 'Last name'
        },
        {
          name: 'position',
          sortField: 'position',
          title: 'Position'
        },
        {
          name: 'employment_date',
          sortField: 'employment_date',
          title: 'Employment date'
        },
        {
          name: 'salary',
          sortField: 'salary',
          title: 'Salary'
        }
      ],
      sortOrder: [
        
      ],
      moreParams: {}
    }
  },
  mounted() {
    this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
    this.$events.$on('filter-reset', e => this.onFilterReset())
  },
  methods: {
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    onFilterSet (filterText) {
      this.moreParams = {
          'filter': filterText
      }
      Vue.nextTick( () => this.$refs.vuetable.refresh())
    },
    onFilterReset () {
      this.moreParams = {}
      Vue.nextTick( () => this.$refs.vuetable.refresh())
    },
    actionCreate (data, index) {
        this.$router.push({ path: `/employee/create` })
      },
  }
}
</script>