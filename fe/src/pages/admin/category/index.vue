<template>
  <a-card title="Danh mục sản phẩm" style="width: 100%">
    <div class="row">
      <div class="col-12">
        <createCategory
          @saveCategorySuccsess="reloadIsSuccess"
        ></createCategory>
        <a-table
          :dataSource="categories"
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
                <editcategory
                  @updateCategorySuccsess="reloadIsSuccess"
                  :id="record.id"
                ></editcategory>
              </div>
              <div class="action-icon">
                <deleteCategory
                  @deleteSuccess="reloadIsSuccess"
                  :idRole="record.id"
                ></deleteCategory>
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
import useCategory from "@/composables/admin/useCategory";
import create from "@/pages/admin/category/create";
import edit from "@/pages/admin/category/edit";
import deleteCategory from "@/pages/admin/category/deleteCategory";
export default {
  name: "index-role",
  components: {
    createCategory: create,
    editcategory: edit,
    deleteCategory,
  },
  setup() {
    const columns = [
      {
        title: "Stt",
        key: "stt",
        align: "center",
      },
      {
        title: "Tên",
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
    storeMenu.onSelectedKeys(["admin-category"]);
    //get rules
    const { categories, getCategories } = useCategory();
    onMounted(getCategories);
    //reload view is createSuccsess
    const reloadIsSuccess = () => {
      getCategories();
    };
    //reload view is deletesuccess
    // const deleteCategorySuccsess = () => {
    //   getCategories();
    // };
    // //reload view is update
    // const updateCategorySuccsess = () => {
    //   getCategories();
    // };
    // const saveCategorySuccsess = () => {
    //   getCategories();
    // };
    return {
      categories,
      columns,
      reloadIsSuccess,
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
