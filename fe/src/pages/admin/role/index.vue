<template>
  <a-card title="role" style="width: 100%">
    <div class="row">
      <div class="col-12">
        <createRole @saveRoleSucess="reloadBeforeCrud"></createRole>
        <a-table
          :dataSource="roles"
          :pagination="{ defaultPageSize: 5 }"
          :columns="columns"
          bordered
          key="id"
        >
          <template #bodyCell="{ column, index, record }">
            <template v-if="column.key === 'stt'">
              <span>{{ index + 1 }}</span>
            </template>
            <template v-if="column.key === 'action'">
              <div class="action-icon">
                <editRole
                  @updateRoleSuccsess="reloadBeforeCrud"
                  :id="record.id"
                ></editRole>
              </div>
              <div class="action-icon">
                <deleteRole
                  @deleteSuccess="reloadBeforeCrud"
                  :idRole="record.id"
                ></deleteRole>
              </div>
            </template>
          </template>
        </a-table>
      </div>
    </div>
  </a-card>
</template>
<script>
import { onMounted } from "vue";

import { useStoreMenu } from "@/store/store-nav-menu";
import useRoles from "@/composables/admin/useRole";
import create from "@/pages/admin/role/create";
import edit from "@/pages/admin/role/edit";
import deleteRole from "@/pages/admin/role/deleteRole";
export default {
  name: "index-role",
  components: {
    createRole: create,
    editRole: edit,
    deleteRole,
  },
  setup() {
    const columns = [
      {
        title: "Stt",
        key: "stt",
        align: "center",
      },
      {
        title: "Index",
        dataIndex: "id",
        key: "id",
        hidden: true,
        align: "center",
      },
      {
        title: "Vai trò",
        dataIndex: "name",
        key: "name",
        align: "center",
      },
      {
        title: "Action",
        key: "action",
        align: "center",
      },
    ].filter((column) => !column.hidden);
    //fix nav bar
    const storeMenu = useStoreMenu();
    storeMenu.onSelectedKeys(["admin-role"]);
    //get rules
    const { roles, getRoles } = useRoles();
    onMounted(getRoles);
    //reload view is createSuccsess
    const reloadBeforeCrud = () => {
      getRoles();
    };
    return {
      roles,
      columns,
      reloadBeforeCrud,
    };
  },
};
</script>

<style scoped>
.action-icon {
  font-size: 20px;
  margin-right: 15px;
  outline: none;
}
.action-icon:hover {
  color: red;
  cursor: pointer;
}
</style>
