<h1>Class List</h1>
<?php echo $add_link ?>
<table>
				<tr>
								<th>Full Name</th>
								<th>Status</th>
								<th>Actions</th>
				</tr>
				<?php foreach($users['User'] as $user): ?>
				<tr>
								<td><a href="/corporate/users/<?php echo $view_link ?>/<?php echo $user['id'] ?>"><?php echo $user['Profile']['first_name'] . ' ' . $user['Profile']['last_name'] ?></a></td>
								<td>Active</td>
								<td><a href="/corporate/users/<?php echo $edit_link ?>/<?php echo $user['id'] ?>">Edit</a> | <a href="/corporate/users/<?php echo $delete_link ?>/<?php echo $user['id'] ?>" onclick="">Delete</a> | <a href="#">Shadow Login</a></td
				</tr>
				<?php endforeach ?>
</table>