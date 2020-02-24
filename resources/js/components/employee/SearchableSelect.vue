<template>
        <!-- object value -->
        <model-select :options="options"
                                v-model="employee"
                                placeholder="select employee"
                                @parentSelected="emit('parentSelected', $event)">
         </model-select>
</template>
 
<script>
  import { ModelSelect } from 'vue-search-select'
 
  export default {
    parentSelected(employee) {
      this.$emit('parentSelected', employee)
    },
    data () {
      return {
        options: [
          { parent_id: '1', text: 'aa' + ' - ' + '1' }
        ],
        employee: {
          parent_id: ''
        }
      }
    },
    methods: {
      reset () {
        this.employee = {}
      },
      selectFromParentComponent () {
        // select option from parent component
        this.employee = this.options[0]
      }
    },
    components: {
      ModelSelect
    },
    mounted() {
      let token = localStorage.getItem('default_auth_token');
      let employeeId = this.$route.params.employeeId;
      this.axios
      .get('/employee/possible_parents/' + employeeId, {
            headers: {
                Authorization: "Bearer " + token
            }
        })
      .then(response => {
        this.options = response.data.data;
      });
    },
  }
</script> 