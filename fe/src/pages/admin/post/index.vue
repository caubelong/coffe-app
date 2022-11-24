<template>
  <a-card title="Bài viết" style="width: 100%">
    <div class="row">
      <div class="col-12">
        <a-button type="primary" style="float: right; margin-bottom: 10px"
          ><router-link :to="{ name: 'admin-post-create' }"
            >Thêm</router-link
          ></a-button
        >
        <a-table
          :dataSource="posts"
          :pagination="{ defaultPageSize: 5 }"
          :columns="columns"
          bordered
          key="id"
        >
          <template #bodyCell="{ column, index, record }">
            <template v-if="column.key === 'stt'">
              <span>{{ index + 1 }}</span>
            </template>
            <template v-if="column.key === 'title'">
              <router-link
                :to="{
                  name: 'admin-post-info',
                  params: { id: record.id },
                }"
                ><h5 class="title-post-link">
                  {{ record.title.toLowerCase() }}
                </h5></router-link
              >
            </template>
            <template v-if="column.key === 'thumbnail'">
              <a-image
                :width="100"
                :src="record.thumbnail"
                :alt="record.name"
              />
            </template>
            <template v-if="column.key === 'status'">
              <span
                class="btn"
                :class="record.status ? 'isActive' : 'notActive'"
                >{{ record.status === 1 ? "Hiển thị" : "Không hiển thị" }}</span
              >
            </template>
            <template v-if="column.key === 'action'">
              <div class="action-icon">
                <router-link
                  :to="{
                    name: 'admin-post-update',
                    params: { id: record.id },
                  }"
                  style="display: block; margin-right: 5px"
                  class="action-icon"
                  ><EditOutlined> ></EditOutlined></router-link
                >
              </div>
              <div class="action-icon">
                <deletePost
                  @deleteSuccess="reloadIsSuccess"
                  :id="record.id"
                ></deletePost>
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
import usePost from "@/composables/admin/usePost";
import deletePost from "@/pages/admin/post/delete_post";
import { EditOutlined } from "@ant-design/icons-vue";
export default {
  name: "index-role",
  components: {
    deletePost,
    EditOutlined,
  },
  setup() {
    const columns = [
      {
        title: "Stt",
        key: "stt",
        align: "center",
      },
      {
        title: "Tiêu đề",
        dataIndex: "title",
        key: "title",
        align: "center",
      },
      {
        title: "Mô tả bài viết",
        dataIndex: "desc",
        key: "desc",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Ảnh mô tả",
        dataIndex: "thumbnail",
        key: "thumbnail",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Trạng thái",
        dataIndex: "status",
        key: "status",
        align: "center",
        responsive: ["md"],
      },
      {
        title: "Action",
        key: "action",
        align: "center",
      },
    ].filter((column) => !column.hidden);
    //fix nav bar
    const storeMenu = useStoreMenu();
    storeMenu.onSelectedKeys(["admin-post"]);
    //get products
    const { posts, getPosts } = usePost();
    onMounted(getPosts);
    //reload view is createSuccsess
    const reloadIsSuccess = () => {
      getPosts();
    };
    return {
      posts,
      columns,
      reloadIsSuccess,
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
  color: #000000;
}
.action-icon:hover {
  color: red;
  cursor: pointer;
}
.title-post-link {
  font-size: 16px;
}
.title-post-link:hover {
  color: red;
}
</style>
