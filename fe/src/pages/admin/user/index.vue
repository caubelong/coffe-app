<template>
  <a-card title="Tài khoản" style="width: 100%">
    <div class="row">
      <div class="col-12">
        <a-button type="primary" style="float: right; margin-bottom: 10px"
          ><router-link :to="{ name: 'admin-user-create' }"
            >Thêm</router-link
          ></a-button
        >
        <a-table
          :dataSource="users"
          :pagination="{ defaultPageSize: 5 }"
          :columns="columns"
          bordered
          key="id"
        >
          <template #bodyCell="{ column, index, record }">
            <template v-if="column.key === 'stt'">
              <span>{{ index + 1 }}</span>
            </template>
            <template v-if="column.key === 'isActive'">
              <span
                class="btn"
                :class="record.isActive ? 'isActive' : 'notActive'"
                >{{
                  record.isActive === 1 ? "Hoạt động" : "Tạm dừng hoạt động"
                }}</span
              >
            </template>
            <template v-if="column.key === 'action'">
              <div class="action-icon">
                <router-link
                  :to="{ name: 'admin-user-update', params: { id: record.id } }"
                  style="display: block; margin-right: 5px"
                  class="action-icon"
                  ><EditOutlined> ></EditOutlined></router-link
                >
              </div>
              <div class="action-icon">
                <delete-user
                  @deleteSuccess="deleteSuccesss"
                  :id="record.id"
                ></delete-user>
              </div>
            </template>
          </template>
        </a-table>
      </div>
    </div>
  </a-card>
</template>

<script>
import { useStoreMenu } from "@/store/store-nav-menu";
import useUser from "@/composables/admin/useUser";
import { onMounted } from "vue";
import deleteUser from "@/pages/admin/user/deleteUser";
import { EditOutlined } from "@ant-design/icons-vue";
export default {
  name: "index-user",
  components: {
    deleteUser,
    EditOutlined,
  },
  setup() {
    const storeMenu = useStoreMenu();
    //  fix menu bar
    storeMenu.onSelectedKeys(["admin-user"]);
    const columns = [
      {
        title: "Stt",
        key: "stt",
        align: "center",
      },
      {
        title: "Tên Tài Khoản",
        dataIndex: "name",
        key: "name",
        align: "center",
        fixed: "left",
        responsive: ["md"],
      },
      {
        title: "Email",
        dataIndex: "email",
        key: "email",
        align: "center",
      },
      {
        title: "Role",
        dataIndex: "role_name",
        key: "role_name",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Trạng thái tài khoản",
        dataIndex: "isActive",
        key: "isActive",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Action",
        key: "action",
        align: "center",
      },
    ];
    const { getUsers, users } = useUser();
    const deleteSuccesss = () => {
      getUsers();
    };
    onMounted(getUsers);
    return {
      users,
      getUsers,
      columns,
      deleteSuccesss,
    };
  },
};
</script>

<style scoped>
.isActive {
  background-color: #42d392;
}
.notActive {
  background-color: #dc143c;
}
.action-icon {
  font-size: 20px;
  margin-right: 15px;
  outline: none;
  color: #000;
}
.action-icon:hover {
  color: red;
  cursor: pointer;
}
</style>
