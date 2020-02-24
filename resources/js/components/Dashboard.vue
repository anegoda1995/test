<template>
  <div>
    <vue-tree-list
      @click="onClick"
      @change-name="onChangeName"
      @delete-node="onDel"
      @add-node="onAddNode"
      :model="data"
      default-tree-node-name="new node"
      default-leaf-node-name="new leaf"
      v-bind:default-expanded="false">
      <span class="icon" slot="addTreeNodeIcon"></span>
      <span class="icon" slot="addLeafNodeIcon"></span>
      <span class="icon" slot="editNodeIcon"></span>
      <span class="icon" slot="delNodeIcon"></span>
      <span class="icon" slot="leafNodeIcon"></span>
      <span class="icon" slot="treeNodeIcon"></span>
    </vue-tree-list>
  </div>
</template>

<script>
  import { VueTreeList, Tree, TreeNode } from 'vue-tree-list'
  export default {
    components: {
      VueTreeList
    },
    data () {
      return {
        data: new Tree([]),
      };
    },
    mounted() {
      this.data = new Tree([]);
      let token = localStorage.getItem('default_auth_token');
      this.axios
      .get('/employee/tree', {
            headers: {
                Authorization: "Bearer " + token
            }
        })
      .then(response => {
        let data = response.data;
        this.data = new Tree(data.data);
      });

    },
    methods: {
      onClick (params) {
        let token = localStorage.getItem('default_auth_token');
        this.axios
        .get('/employee/tree/' + params.id, {
              headers: {
                  Authorization: "Bearer " + token
              }
          })
        .then(response => {
          var children = response.data.data;
          params.children = [];
          children.forEach(function callback(child, index, children) {
            var child = new TreeNode(child)
            params.addChildren(child);
          });
        });
      },      
    }
  }
</script>

<style lang="less" rel="stylesheet/less">
  .vtl {
    .vtl-drag-disabled {
      background-color: #d0cfcf;
      &:hover {
        background-color: #d0cfcf;
      }
    }
    .vtl-disabled {
      background-color: #d0cfcf;
    }
  }
</style>

<style lang="less" rel="stylesheet/less" scoped>
  .icon {
    &:hover {
      cursor: pointer;
    }
  }
</style>