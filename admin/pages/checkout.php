<?php require 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        .content-wrapper {
            display: flex;
            gap: 20px;
        }

        .product-list {
            flex: 2;
        }

        .order-summary {
            flex: 1;
            border-left: 1px solid #ddd;
            padding-left: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        #scanButton {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <div class="product-list">
            <h1>Thanh toán</h1>
            <button id="scanButton">Quét Mã</button>
            <div style="margin-bottom: 20px;">
                <input type="text" id="searchBox" placeholder="Tìm kiếm sản phẩm..." onkeyup="searchProduct()" />
                <div id="searchSuggestions"
                    style="border: 1px solid #ddd; display: none; position: absolute; background: #fff; z-index: 1000; max-height: 200px; overflow-y: auto;">
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá bán</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    <tr>
                        <td colspan="6">Chưa có sản phẩm</td>
                    </tr>
                    <tr>
                        <div id="discountSummary" style="font-weight: bold; color: red">
                            <p>Giảm giá: 0 đ</p> <!-- Hiển thị giảm giá tại đây -->
                        </div>
                        <td colspan="4" style="text-align: right; font-weight: bold;">Tổng tiền đơn hàng:</td>
                        <td id="orderTotal" colspan="2" style="font-weight: bold;">0 đ</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="order-summary"
            style="display: flex; flex-direction: column; justify-content: space-between; height: 100%; padding-top: 20px;">
            <div style="align-self: flex-end; text-align: right;">
                <p id="currentDateTime"></p>
            </div>
            <!-- <div class="col-sm-6">
                <div class="form-group">
                    <label>Mã giảm giá</label>
                    <input name="" type="text" class="form-control" aria-describedby="textHelp">
                    <button>Áp dụng</button>
                </div>
            </div> -->
            <div class="col-sm-6">

                <div class="form-group">
                    <label for="paymentMethod">Phương thức thanh toán:</label>
                    <select id="paymentMethod" onchange="togglePaymentOptions()" required class="form-control">\
                        <option value="Tiền mặt">Tiền mặt</option>
                        <option value="Chuyển khoản">Chuyển khoản</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6" id="transferOptions" style="display: none;">
                <div class="form-group">
                    <label for="transferType">Loại chuyển khoản:</label>
                    <select id="transferType" required class="form-control">
                        <option value="momo">Chuyển khoản MoMo</option>
                        <option value="bank">Chuyển khoản Ngân hàng</option>
                    </select>
                </div>
            </div>
            <div>
                <button onclick="processPayment()" class="btn btn-outline-success">Thanh toán</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        const productList = []; // Định nghĩa biến productList ở đây để có thể truy cập từ nhiều nơi.

        function calculateTotal(product) {
            return product.GiaBan * product.quantity;
        }

        function calculateOrderTotal() {
            return productList.reduce((total, product) => total + calculateTotal(product), 0);
        }

        window.printInvoice = function () {
            const invoiceData = {
                products: productList,
                paymentMethod: document.getElementById('paymentMethod').value // Lấy giá trị phương thức thanh toán
            };

            sessionStorage.setItem('invoiceData', JSON.stringify(invoiceData));
            window.open('invoice.html', '_blank'); // Mở trang hóa đơn mới
        };

        function togglePaymentOptions() {
            const paymentMethod = document.getElementById('paymentMethod').value;
            const transferOptions = document.getElementById('transferOptions');
            transferOptions.style.display = (paymentMethod === 'Chuyển khoản') ? 'block' : 'none';
        }

        function updateDateTime() {
            const currentDateTime = new Date();
            const formattedDateTime = currentDateTime.toLocaleString('vi-VN', {
                day: '2-digit', month: '2-digit', year: 'numeric',
                hour: '2-digit', minute: '2-digit', second: '2-digit'
            });
            document.getElementById('currentDateTime').textContent = formattedDateTime;
        }

        // Cập nhật thời gian hiện tại
        updateDateTime();
        setInterval(updateDateTime, 1000);

        document.addEventListener('DOMContentLoaded', function () {
            const channel = new BroadcastChannel('product_channel');
            const productTableBody = document.getElementById('productTableBody');
            const orderTotalDiv = document.getElementById('orderTotal');
            const scanButton = document.getElementById('scanButton');

            // Hàm tìm kiếm sản phẩm
            function findProduct(productCode) {
                return productList.find(product => product.ma_theo_lo === productCode);
            }

            scanButton.addEventListener('click', function () {
                window.open('scan.html', 'ScanQRPopup', 'width=600,height=600');
            });

            channel.onmessage = function (event) {
                if (event.data) {
                    const existingProduct = findProduct(event.data.ma_theo_lo);
                    if (existingProduct) {
                        existingProduct.quantity += 1;
                    } else {
                        productList.push({ ...event.data, quantity: 1 });
                    }
                    renderProductList();
                }
            };

            // Hàm render danh sách sản phẩm
            function renderProductList() {
                productTableBody.innerHTML = '';

                if (productList.length === 0) {
                    productTableBody.innerHTML = '<tr><td colspan="5">Chưa có sản phẩm</td></tr>';
                } else {
                    productList.forEach((product, index) => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${product.ma_theo_lo}</td>
                    <td>${product.TenSP}</td>
                    <td>${product.GiaBan} đ</td>
                    <td>
                        <input type="number" value="${product.quantity}" 
                               min="1" 
                               onchange="updateQuantity(${index}, this.value)" />
                    </td>
                    <td>${calculateTotal(product)} đ</td>
                    <td> <button class="btn btn-danger" onclick="removeProduct(${index})">Xóa</button></td>
                `;
                        productTableBody.appendChild(row);
                    });
                }

                const totalRow = document.createElement('tr');
                totalRow.innerHTML = `
            <td colspan="4" style="text-align: right; font-weight: bold;">Tổng tiền đơn hàng:</td>
            <td id="orderTotal" colspan="1" style="font-weight: bold;">${calculateOrderTotal()} đ</td>
            <td></td>
        `;
                productTableBody.appendChild(totalRow);
            }

            window.updateQuantity = function (index, newQuantity) {
                productList[index].quantity = parseInt(newQuantity, 10);
                renderProductList();
            };

            window.removeProduct = function (index) {
                productList.splice(index, 1);
                renderProductList();
            };

            // Tìm kiếm sản phẩm
            function searchProduct() {
                const searchBox = document.getElementById('searchBox');
                const suggestionsBox = document.getElementById('searchSuggestions');
                const keyword = searchBox.value.trim();

                if (!keyword) {
                    suggestionsBox.style.display = 'none';
                    return;
                }

                fetch(`search_products.php?keyword=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(products => {
                        if (Array.isArray(products)) {
                            renderSuggestions(products);
                        } else {
                            console.error('Dữ liệu trả về không hợp lệ');
                        }
                    })
                    .catch(err => console.error('Lỗi khi tìm kiếm:', err));
            }
            // Render gợi ý tìm kiếm
            function renderSuggestions(products) {
                const suggestionsBox = document.getElementById('searchSuggestions');
                suggestionsBox.innerHTML = '';
                products.forEach(product => {
                    const suggestion = document.createElement('div');
                    suggestion.textContent = `${product.ma_theo_lo} - ${product.TenSP}`;
                    suggestion.style.padding = '10px';
                    suggestion.style.cursor = 'pointer';
                    suggestion.onclick = () => addProductToList(product);
                    suggestionsBox.appendChild(suggestion);
                });
                suggestionsBox.style.display = 'block';
            }

            // Hàm thêm sản phẩm vào danh sách
            function addProductToList(product) {
                const existingProduct = productList.find(p => p.ma_theo_lo === product.ma_theo_lo);

                if (existingProduct) {
                    existingProduct.quantity += 1; // Nếu đã có sản phẩm, tăng số lượng
                } else {
                    productList.push({
                        ma_theo_lo: product.ma_theo_lo,
                        TenSP: product.TenSP,
                        GiaBan: product.GiaBan,
                        quantity: 1 // Số lượng mặc định là 1
                    });
                }

                // Xóa giá trị trong ô tìm kiếm
                document.getElementById('searchBox').value = '';

                // Ẩn gợi ý
                document.getElementById('searchSuggestions').style.display = 'none';

                // Cập nhật danh sách sản phẩm
                renderProductList();
            }

            // Sự kiện tìm kiếm sản phẩm khi gõ vào ô tìm kiếm
            document.getElementById('searchBox').addEventListener('input', searchProduct);
        });

    </script>
    <?php $ch = curl_init('http://localhost/website/admin/pages/get_promo.php');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if ($response === false) {
        die("Lỗi cURL: " . curl_error($ch));
    }

    curl_close($ch);

    $json_data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        die("JSON lỗi: " . json_last_error_msg());
    }

    echo "<pre>";
    print_r($json_data);
    echo "</pre>";
    ?>
    <script>
        // Dữ liệu khuyến mãi từ PHP
        const promotions = <?php echo json_encode($json_data); ?>;
        console.log('promotion ===>', promotions);  
    </script>
</body>

</html>

<?php require 'footer.php'; ?>