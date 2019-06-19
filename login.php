
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="loginModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2 style="color:black;" class="modal-title">Login</h2>
        </div>
        <div class="modal-body" style="background-color:#052c46;">
			<div class="modalClass">
			<form id="login_form" method="POST">
			  <div class="form-group">
				<label style="color:white;" for="email">Email address:</label>
				<input type="email" class="form-control" name="loginEmail" id="email" placeholder="Email" required>
			  </div>
			  <div class="form-group">
				<label style="color:white;" for="pwd">Password:</label>
				<input type="password" class="form-control" name="loginPassword" id="pwd" placeholder="Password" required>
			  </div>
			  <center><h3 id="loginResult"></h3></center>
			  <button type="submit" class="btn btn-default" >Submit</button>
			</form>
			</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>