<div class="content container-fluid">
    Welcome Message
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Home Page</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Welcome Message</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card comman-shadow">
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="form-title student-info">Manage Message <span><a href="javascript:;"><i
                                                class="feather-more-vertical"></i></a></span></h5>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group local-forms">
                                    <label>Title <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" wire:model.live='title'>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Full Name <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" pwire:model.live='name'>
                                </div>
                            </div>
                            <div class="col-12 col-sm-3">
                                <div class="form-group local-forms">
                                    <label>Designation <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" wire:model.live='designation'>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group local-forms">
                                    <label>Quoted Message </label>
                                    <textarea class="form-control" placeholder="Will appear in quote" wire:model.live='quoted_text'></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12">
                                <div class="form-group local-forms">
                                    <label>Message </label>
                                    <textarea class="form-control" placeholder="Welcome message" wire:model.live='message'></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group students-up-files">
                                    <label>Upload Photo (600 X 650)</label>
                                    <div class="uplod">
                                        <label class="mb-0 file-upload image-upbtn">
                                            Upload Current Photo <input type="file" wire:model.live='photo'>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="student-submit">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
