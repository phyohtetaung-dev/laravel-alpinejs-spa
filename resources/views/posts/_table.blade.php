<table class="table">
    <thead>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Last Modified</th>
        <th style="width: 200px;">Actions</th>
    </thead>
    <tbody x-init="getPosts">
        <template x-for="data in paginatedPosts" :key="data.id">
            <tr>
                <td x-text="data.id"></td>
                <td x-text="data.title"></td>
                <td x-text="data.description"></td>
                <td x-text="data.updated_at"></td>
                <td>
                    <button class="btn btn-success btn-sm" @click="edit(data)">Edit</button>
                    <button class="btn btn-danger btn-sm" @click="destroy(data.id)">Delete</button>
                </td>
            </tr>
        </template>
    </tbody>
</table>

<!--Message to display when no results-->
<div class="mx-auto flex items-center font-bold" x-show="!total">
    <span class="mx-auto text-danger"> There is no post!! </span>
</div>