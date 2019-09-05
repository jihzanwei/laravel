@extends('layout.parent')
@section('pages_section')
<div class="checkout pages section">
		<div class="container">
			<div class="pages-head">
				<h3>CHECKOUT</h3>
			</div>
			<div class="checkout-content">
				<div class="row">
					<div class="col s12">
						<ul class="collapsible" data-collapsible="accordion">
							
						
							<li>
								<div class="collapsible-header"><h5>1 - 运输信息</h5></div>
								<div class="collapsible-body" style="">
									<div class="shipping-information">
										<form action="#">
											<div class="input-field">
												<h5>Name*</h5>
												<input type="text" class="validate" required="">
											</div>
											<div class="input-field">
												<h5>Email*</h5>
												<input type="email" class="validate" required="">
											</div>
											
											
											<div class="input-field">
												<h5>Phone*</h5>
												<input type="number" class="validate" required="">
											</div>
											<a href="" class="btn button-default">CONTINUE</a>
										</form>
									</div>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><h5>2 - 付款方式</h5></div>
								<div class="collapsible-body" style="">
									<div class="payment-mode">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur provident repellat</p>
										<form action="#" class="checkout-radio">
												<div class="input-field">
													<input type="radio" class="with-gap" id="bank-transfer" name="group1">
													<label for="bank-transfer" id="1"><span>银行转账</span></label>
												</div>
												<div class="input-field">
													<input type="radio" class="with-gap" id="cash-on-delivery" name="group1">
													<label for="cash-on-delivery" id="2"><span>货到付款</span></label>
												</div>
												<div class="input-field">
													<input type="radio" class="with-gap" id="online-payments" name="group1">
													<label for="online-payments" id="3"><span>支付宝支付</span></label>
												</div>
	
											<a href="" class="btn button-default">CONTINUE</a>
										</form>
									</div>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><h5>3 - 订单审核</h5></div>
								<div class="collapsible-body" style="">
									<div class="order-review">
										<div class="row">
                                        @foreach($goodsInfo as $item)
											<div class="col s12">
												<div class="cart-details">
													<div class="col s5">
														<div class="cart-product">
															<h5>Image</h5>
														</div>
													</div>
													<div class="col s7">
														<div class="cart-product">
															<img src="{{$item->goods_pic}}" width="100px;" height="100px;">
														</div>
													</div>
												</div>
												<div class="divider"></div>
												<div class="cart-details">
													<div class="col s5">
														<div class="cart-product">
															<h5>Name</h5>
														</div>
													</div>
													<div class="col s7">
														<div class="cart-product">
															<a href="">{{$item->goods_name}}</a>
														</div>
													</div>
												</div>
												<div class="divider"></div>
												<div class="cart-details">
													<div class="col s5">
														<div class="cart-product">
															<h5>Quantity</h5>
														</div>
													</div>
													<div class="col s7">
														<div class="cart-product">
															{{$item->goods_number}}
														</div>
													</div>
												</div>
												<div class="divider"></div>
												<div class="cart-details">
													<div class="col s5">
														<div class="cart-product">
															<h5>Unit Price</h5>
														</div>
													</div>
													<div class="col s7">
														<div class="cart-product">
															<span>${{$item->goods_price}}</span>
														</div>
													</div>
												</div>
												<div class="cart-details">
													<div class="col s5">
														<div class="cart-product">
															<h5>Total Price</h5>
														</div>
													</div>
													<div class="col s7">
														<div class="cart-product">
															<span>${{$item->goods_price}}</span>
														</div>
													</div>
												</div>
											</div>
                                            @endforeach
										</div>
									</div>
									<div class="order-review final-price">
										<div class="row">
											<div class="col s12">
											
												
												<div class="cart-details">
													<div class="col s8">
														<div class="cart-product">
															<h5>Total</h5>
														</div>
													</div>
													<div class="col s4">
														<div class="cart-product">
															<span>${{$total}}</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<a href="" class="btn button-default button-fullwidth">CONTINUE</a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<h2 align="center">
<a href="javascript:;" class="aaa">保存订单</a>
</h2>
@endsection

@section('js')
<script>
    $(function(){
        $('.aaa').click(function(){
    //   alert(111)
            var _this=$(this);
            var input=$('.with-gap');
            // console.log(input);return false;
                  var pay_name=input.next().find('span').text();
            // alert(pay_name)
                        var a=new Array();
            // console.log(check);return false;
             input.each(function(){
                var check=$(this).prop('checked');
                // a.push(check); 
                if(check==true){
                    var pay_id=$(this).next().attr('id');
                    // console.log(pay_id);
                    a.push(pay_id);
                    var pay_name=$(this).next().text();
                    // console.log(pay_name);
                    a.push(pay_name);
				// alert(a);
                    
                }
            });
                  var shop=new Array();
            var shopping=$('.validate');
            shopping.each(function(){
                var value=$(this).val();
                // console.log(value);
                shop.push(value);
            });
            // console.log(shop);return false;
            // console.log(shopping);return false;
            // console.log(a);
            var goods_id="{{$goods_id}}";
            // alert(goods_id);
            var total={{$total}};
			// alert(11111);
            // alert(total);
                 $.get(
                // alert(11)
                "{{url('order/create')}}",
             
                {shopping:shop,good_ids:goods_id,total:total,pay:a},
                function(res){
					// console.log(res);
					if(res.code==1){
						// alert(1111);return false;
						alert(res.msg);
						window.location.href="{{url('order/indexs')}}?goods_id="+goods_id;
					}else{
						alert(res.msg);
					}
                },
				'json'

            );
        });
    })
  
    
        // $('.aaa').click(function(){
            
        //     alert(111);die();
        //     var _this=$(this);
        //     var input=$('.with-gap');
        //     // console.log(input);return false;
        //     var pay_name=input.next().find('span').text();
        //     // console.log(pay_name);
        //     var a=new Array();
        //     // console.log(check);return false;
            
        //     // console.log(check);
        //     input.each(function(){
        //         var check=$(this).prop('checked');
        //         // a.push(check); 
        //         if(check==true){
        //             var pay_id=$(this).next().attr('id');
        //             // console.log(pay_id);
        //             a.push(pay_id);
        //             var pay_name=$(this).next().text();
        //             // console.log(pay_name);
        //             a.push(pay_name);
		// 		// console.log(a);;
                    
        //         }
        //     });
		// 	// return false
        //     var shop=new Array();
        //     var shopping=$('.validate');
        //     shopping.each(function(){
        //         var value=$(this).val();
        //         // console.log(value);
        //         shop.push(value);
        //     });
        //     // console.log(shop);return false;
        //     // console.log(shopping);return false;
        //     // console.log(a);
        //     var goods_id="{{$goods_id}}";
        //     // alert(goods_id);
        //     var total={{$total}};
		// 	// alert(11111);
        //     // alert(total);
        //     $.get(
        //         // alert(11)
        //         "{{url('order/create')}}",
        //         die();
        //         {shopping:shop,good_ids:goods_id,total:total,pay:a},
        //         function(res){
		// 			// console.log(res);
		// 			if(res.code==1){
		// 				// alert(1111);return false;
		// 				alert(res.msg);
		// 				window.location.href="{{url('order/indexs')}}?goods_id="+goods_id;
		// 			}else{
		// 				alert(res.msg);
		// 			}
        //         },
		// 		'json'

        //     );
            
        // });
  
</script>
@endsection