<!-- Transaction History -->
<div class="modal fade" id="transaction">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Transaction Full Details</b></h4>
            </div>
            <div class="modal-body">
                <p>
                    Date: <span id="date"></span>
                    <span class="pull-right">Transaction#: <span id="transid"></span> </span>
                </p>
                <table class="table table-bordered">
                    <thead>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </thead>
                    <tbody id="detail">
                        <tr>
                            <td colspan="3" style="text-align: right;"><b>Total</b></td>
                            <td><span id="total"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-labe="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Update Acount</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="profile_edit.php" method="POST" data-type="">
                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Firstname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $user['firstname'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-sm-3 control-label">Lastname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $user['lastname'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $user['email'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password" value="<?php echo $user['password'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact" class="col-sm-3 control-label">Contact Info</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="contact" id="contact" value="<?php echo $user['contact_info'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="address" id="address"><?php echo $user['address'];?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" id="photo">
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label for="curr_password" class="col-sm-3 control-label">Current Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="curr_password" id="curr_password" placeholder="Input current password to save changes" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button class="btn btn-success btn-flat pull-right" name="edit"><i class="fa fa-close"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>