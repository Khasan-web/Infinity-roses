<?php

use yii\base\Widget;
use app\components\AdminTitle;

?>

<?= AdminTitle::widget(['title' => 'Dashboard', 'breadcrumbs' => ''])?>
<!--BEGIN CONTENT-->
<div class="page-content">
    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered table-advanced tablesorter">
            <thead>
            <tr>
                <th width="9%">Record #</th>
                <th>Username</th>
                <th width="10%">Country</th>
                <th width="10%">Gender</th>
                <th width="7%">Order</th>
                <th width="12%">Date</th>
                <th width="10%">Price</th>
                <th width="9%">Status</th>
                <th width="18%">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Henry</td>
                <td>United States</td>
                <td>Male</td>
                <td>32</td>
                <td>20-05-2014</td>
                <td>$240.50</td>
                <td><span class="label label-sm label-success">Approved</span></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-edit"></i>&nbsp;
                        Edit
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                        Delete
                    </button>
                    <button type="button" class="btn btn-info btn-xs view"><i class="fa fa-eye"></i>&nbsp;
                        View
                    </button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>John</td>
                <td>United States</td>
                <td>Female</td>
                <td>45</td>
                <td>20-05-2014</td>
                <td>$240.50</td>
                <td><span class="label label-sm label-info">Pending</span></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-edit"></i>&nbsp;
                        Edit
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                        Delete
                    </button>
                    <button type="button" class="btn btn-info btn-xs view"><i class="fa fa-eye"></i>&nbsp;
                        View
                    </button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Larry</td>
                <td>United States</td>
                <td>Female</td>
                <td>40</td>
                <td>20-05-2014</td>
                <td>$240.50</td>
                <td><span class="label label-sm label-warning">Suspended</span></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-edit"></i>&nbsp;
                        Edit
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                        Delete
                    </button>
                    <button type="button" class="btn btn-info btn-xs view"><i class="fa fa-eye"></i>&nbsp;
                        View
                    </button>
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>Lahm</td>
                <td>United States</td>
                <td>Female</td>
                <td>15</td>
                <td>20-05-2014</td>
                <td>$240.50</td>
                <td><span class="label label-sm label-danger">Blocked</span></td>
                <td>
                    <button type="button" class="btn btn-default btn-xs"><i class="fa fa-edit"></i>&nbsp;
                        Edit
                    </button>
                    &nbsp;
                    <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                        Delete
                    </button>
                    <button type="button" class="btn btn-info btn-xs view"><i class="fa fa-eye"></i>&nbsp;
                        View
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>