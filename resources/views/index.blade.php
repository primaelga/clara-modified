    <link href="/assets/styles/kendo.common.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/styles/kendo.dataviz.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/styles/kendo.flat.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/styles/kendo.dataviz.flat.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/kendo.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.js"> </script>
<body>	
<div id="example">
        <div id="grid"></div>

        <script type="text/x-kendo-template" id="detail-template">
            <div class="tabstrip">
                <ul>
                    <li class="k-state-active">User Information</li>
                </ul>
                <div class="user-details">
                    <ul>
                        <li><label>Name:</label>#= name #</li>
                        <li><label>Address:</label>#= address #</li>
                        <li><label>Email:</label>#= email #</li>
                        <li><label>Phone:</label>#= phone #</li>
                    </ul>
                </div>
            </div>
        </script>

        <script type="text/javascript">
            var wnd, detailsTemplate;

            $(document).ready(function () {
                var dataSource = new kendo.data.DataSource({
                    type: "json",
                    requestEnd: function (e) {
                        if (e.type !== "read") {
                            dataSource.read();
                        }
                    },
                    transport: {
                        read: {
                            url: "http://localhost:8000/api/services/person",
                            contentType: "application/json",
                            type: "GET"
                        },
                        update: {
                            url: "http://localhost:8000/api/service/person",
                            //contentType: "application/json",
                            type: "put"
                        },
                        create: {
                            url: "http://localhost:8000/api/service/person",
                            type: "post"
                        },
                        destroy: {
                            url: "http://localhost:8000/api/service/person",
                           // contentType: "application/json",
                            type: "delete"
                        },
//                        parameterMap: function (options, operation) {
//                            if (operation !== "read" && options.models) {
//                                return { models: kendo.stringify(options.models) };
//                            } else {
//                                return JSON.stringify(options);
//                            }
//                        }
                    },
                    serverPaging: true,
                    serverSorting: true,
                    serverFiltering: true,
                    pageSize: 10,
                    schema: {
                        data: "Data",
                        total: "Total",
                        model: {
                            id: "id",
                            fields: {
                                id: { editable: false, nullable: true },
                                name: { validation: { required: true } },
                                address: { validation: { required: true } },
                                email: { validation: { required: true } },
                                phone: { validation: { required: true } }
                            }
                        }
                    }
                });

                function detailInit(e) {
                    var detailRow = e.detailRow;

                    detailRow.find(".tabstrip").kendoTabStrip({
                        animation: {
                            open: { effects: "fadeIn" }
                        }
                    });
                }

                $("#grid").kendoGrid({
                    dataSource: dataSource,
                    groupable: true,
                    sortable: true,
                    filterable: true,
                    pageable: {
                        refresh: true,
                        pageSizes: true,
                        buttonCount: 5
                    },
                    detailTemplate: kendo.template($("#detail-template").html()),
                    detailInit: detailInit,
                    toolbar: ["create"],
                    columns: [
//                         {
//                            field: "id",
//                            title: "id"
//                        },
                        {
                            field: "name",
                            title: "Name"
                        }, {
                            field: "address",
                            title: "Address"
                        }, {
                            field: "email",
                            title: "Email"
                        },{
                            field: "phone",
                            title: "Phone"
                        },
                        {
                            command: ["edit", "destroy"],
                            title: "&nbsp;",
                            width: "300px"
                        }
                    ],
                    editable: "popup"
                });
            });
        </script>	
</body>	