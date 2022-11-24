<template>
  <a-card title="Topping" style="width: 100%">
    <div class="row">
      <div class="col-12">
        <a-button type="primary" style="float: right; margin-bottom: 10px"
          ><router-link :to="{ name: 'admin-topping-create' }"
            >Thêm</router-link
          ></a-button
        >
        <a-table
          :dataSource="toppings"
          :pagination="{ defaultPageSize: 5 }"
          :columns="columns"
          bordered
          key="id"
        >
          <template #bodyCell="{ column, index, record }">
            <template v-if="column.key === 'stt'">
              <span>{{ index + 1 }}</span>
            </template>
            <template v-if="column.key === 'price'">
              <span>{{
                record.discount - 0
                  ? " giá gốc : " +
                    (record.price - 0) / 1 +
                    "đ" +
                    "  | " +
                    "giá sau khi giảm : " +
                    ((record.price - 0) * (100 - (record.discount - 0))) / 100 +
                    "đ"
                  : (record.price - 0).toFixed(0) + "đ"
              }}</span>
            </template>
            <template v-if="column.key === 'status'">
              <span
                class="btn"
                :class="record.status ? 'isActive' : 'notActive'"
                >{{
                  record.status === 1 ? "Hoạt động" : "Tạm dừng hoạt động"
                }}</span
              >
            </template>
            <template v-if="column.key === 'action'">
              <div class="action-icon">
                <router-link
                  :to="{
                    name: 'admin-topping-edit',
                    params: { id: record.id },
                  }"
                  style="display: block; margin-right: 5px"
                  class="action-icon"
                  ><EditOutlined> ></EditOutlined></router-link
                >
              </div>
              <div class="action-icon">
                <deleteTopping
                  @deleteSuccess="deleteSuccess"
                  :id="record.id"
                ></deleteTopping>
              </div>
            </template>
          </template>
        </a-table>
      </div>
    </div>
  </a-card>
</template>

<script>
import deleteTopping from "@/pages/admin/topping/deleteTopping";
import axios from "axios";
import { useStoreMenu } from "@/store/store-nav-menu";
import useTopping from "@/composables/admin/useTopping";
import { onMounted } from "vue";
import { EditOutlined } from "@ant-design/icons-vue";
export default {
  name: "index-user",
  components: {
    EditOutlined,
    deleteTopping,
  },
  setup() {
    const storeMenu = useStoreMenu();
    //  fix menu bar
    storeMenu.onSelectedKeys(["admin-topping"]);
    const columns = [
      {
        title: "Stt",
        key: "stt",
        align: "center",
      },
      {
        title: "Tên Topping",
        dataIndex: "name",
        key: "name",
        align: "center",
      },
      {
        title: "Discount ( % ) ",
        dataIndex: "discount",
        key: "discount",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Price",
        dataIndex: "price",
        key: "price",
        align: "center",
      },
      {
        title: "Trạng thái",
        dataIndex: "status",
        key: "status",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Người tạo",
        dataIndex: "created_by",
        key: "created_by",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Action",
        key: "action",
        align: "center",
      },
    ];
    const { toppings, getToppings } = useTopping();
    onMounted(() => {
      getToppings();
    });
    const deleteSuccess = () => {
      getToppings();
    };
    return {
      columns,
      toppings,
      deleteSuccess,
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
