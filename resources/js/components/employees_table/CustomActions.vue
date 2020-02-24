<template>
    <div class="custom-actions">
      <button class="ui basic button" @click="actionUpdate(rowData, rowIndex)"><i class="edit icon"></i></button>
      <button class="ui basic button" @click="actionDelete(rowData, rowIndex)"><i class="delete icon"></i></button>
    </div>
  </template>

  <script>
  export default {
    props: {
      rowData: {
        type: Object,
        required: true
      },
      rowIndex: {
        type: Number
      }
    },
    methods: {
      actionUpdate (data, index) {
        this.$router.push({ path: `/employee/${data.id}/edit` })
      },
      actionDelete (data, index) {
        let token = localStorage.getItem('default_auth_token');
        let employeeId = this.$route.params.employeeId;
        this.axios
        .delete(`/employee/${data.id}`, {
              headers: {
                  Authorization: "Bearer " + token
              }
          })
        .then(response => {
        });
      }
    }
  }
  </script>

  <style>
    .custom-actions button.ui.button {
      padding: 8px 8px;
    }
    .custom-actions button.ui.button > i.icon {
      margin: auto !important;
    }
  </style>