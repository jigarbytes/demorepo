if (typeof _ === 'undefined') _ = require('../../lib/lodash-v1.3.1.js')
if (typeof u === 'undefined') u = require('../u.js')
if (typeof ca === 'undefined') ca = require('../collection.js')
if (typeof etsysku === 'undefined') etsysku = require('../etsysku-functions.js')
if (typeof TEST === 'undefined') TEST = require('./test.js')

describe('main etsysku', function() {
  afterEach(TEST.afterEach)

  function fakeEtsyOrder(o) {
    return _.assign({
        "receipt_id": 1203151258,"receipt_type": 0,"order_id": 511556738,"seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,
        "last_modified_tsz": 1497272330,"name": "Robin Ferragamo","first_line": "Robin","second_line": "47 Claradon Lane","city": "Staten Island",
        "state": "NY","zip": "10305","country_id": 209,"payment_method": "cc","payment_email": "","message_from_buyer": null,"was_paid": true,
        "total_tax_cost": "2.00","total_vat_cost": "1.80","total_price": "70.00","total_shipping_cost": "2.99","currency_code": "USD","message_from_payment": null,
        "was_shipped": true,"buyer_email": "vvinrobali@aol.com","seller_email": "melissa@sweetwaterdecor.com","discount_amt": "5.00","subtotal": "70.00",
        "grandtotal": "72.99","adjusted_grandtotal": "72.99","shipping_tracking_code": "9400111699000410247149",
        "shipping_tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075","shipping_carrier": "USPS",
        "shipping_note": "","shipping_notification_date": 1497272330,
        "shipments": [{
                "receipt_shipping_id": 156098400075,"mailing_date": 1497272330,"carrier_name": "USPS","tracking_code": "9400111699000410247149",
                "major_tracking_state": "Shipped","current_step": "shipped","current_step_date": null,"mail_class": null,"buyer_note": "",
                "notification_date": 1497272330,"is_local_delivery": false,"local_delivery_id": null,
                "tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075?mutv=0kO99U8dkMV3SlSs86OAJU-dfFfe7AOj7xxUqYAIAzGeAuZkqAdx4Ppr7TL6Ajhia2jl4S8hOk6UH70w2pa3ptu_V-abDGON-3lQ27WKPhhksfw1F1u0F8Wr7Atpd6PrwR"
            }],
        "has_local_delivery": false,
        "shipping_details": {"can_mark_as_shipped": false,"was_shipped": true,"is_future_shipment": false,"shipment_date": 1497272330,"not_shipped_state_display": "Not Shipped",
            "has_upgrade": true,"upgrade_name": "USPS First Class Package Services","shipping_method": "USPS First Class Package Services"},
        "transparent_price_message": "","show_channel_badge": false,"channel_badge_suffix_string": "",
        "transactions": [{
                "transaction_id": 1283842164,
                "title":"Boss Lady Pen Set",
                "seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,"paid_tsz": 1497245327,
                "shipped_tsz": 1497272330,"price": "15.00","currency_code": "USD","quantity": 1,"image_listing_id": 1208449139,
                "receipt_id": 1203151258,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 399585557,
                "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
                "url": "https:\/\/www.etsy.com\/transaction\/1283842164",
                "variations": [],
                "product_data": {"product_id": 38571872,"sku": "99012","property_values": [],
                    "offerings": [{"offering_id": 39261095,
                            "price": {"amount": 1500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD",
                                "currency_formatted_raw": "15.00"},
                            "quantity": 121,"is_enabled": 1,"is_deleted": 0}
                        ],
                        "is_deleted": 0
                    }
                },{
                "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book",
                "seller_user_id": 29897567,"buyer_user_id": 110067200,"creation_tsz": 1496758379,"paid_tsz": 1496758394,
                "shipped_tsz": null,"price": "55.00","currency_code": "USD","quantity": 1,"image_listing_id": 1202700319,
                "receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 502938896,
                "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
                "url": "https:\/\/www.etsy.com\/transaction\/1293312015",
                "variations": [{"property_id": 510,"value_id": 55615622348,"formatted_name": "Style","formatted_value": "Large"}],
                "product_data": {"product_id": 1069080711,"sku": "99010",
                    "property_values": [{"property_id": 510,"property_name": "Style","scale_id": null,"scale_name": null,
                      "value_ids": [3020298485],
                      "values": ["Large"]}],
                    "offerings": [{"offering_id": 1250026666,
                            "price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD",
                                "currency_formatted_raw": "55.00"},
                            "quantity": 474,"is_enabled": 1,"is_deleted": 0}
                    ],
                    "is_deleted": 0
                }
            }
        ]
    }, o)
  }

var expectedRowsHeader = ('orderType orderOrderId orderStatus orderOrderDate orderOrigin orderCustomer orderSaleSource ' +
                          'orderItemItemIndex orderItemProductId orderItemItemNote orderItemQuantity orderItemUnitPrice ' +
                          'orderAdjustmentItemItemIndex orderAdjustmentItemDiscountFee orderAdjustmentItemDescription orderAdjustmentItemAmount ' +
                          'shipmentType shipmentShipmentId shipmentStatus shipmentShipDate ' +
                          'shipmentItemItemIndex shipmentItemProductId shipmentItemQuantity shipmentItemMagazine ' +
                          'invoiceInvoiceId invoiceInvoiceDate invoiceStatus ' +
                          'invoiceItemItemIndex invoiceItemType invoiceItemProductId invoiceItemItemNote invoiceItemDiscountFee invoiceItemQuantity invoiceItemUnitPrice invoiceItemAmount ' +
                          'orderShipToName orderShipToStreetAddress orderShipToCity orderShipToStateRegion orderShipToPostalCode orderShipToCountry orderShipToAdditionalLines ').w()

var expectedRowsHeaderNoShipmentItem = _.filter(expectedRowsHeader, function(cur) { return !cur.startsWith('shipmentItem') })

var paymentNoMatching = {
    "receipt_id": 1203151258,"receipt_type": 0,"order_id": 511556738,"seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,
    "last_modified_tsz": 1497272330,"name": "Robin Ferragamo","first_line": "Robin","second_line": "47 Claradon Lane","city": "Staten Island",
    "state": "NY","zip": "10305","country_id": 209,"payment_method": "cc","payment_email": "","message_from_buyer": null,"was_paid": true,
    "total_tax_cost": "0.00","total_vat_cost": "0.00","total_price": "15.00","total_shipping_cost": "2.99","currency_code": "USD","message_from_payment": null,
    "was_shipped": true,"buyer_email": "vvinrobali@aol.com","seller_email": "melissa@sweetwaterdecor.com","discount_amt": "0.00","subtotal": "15.00",
    "grandtotal": "17.99","adjusted_grandtotal": "17.99","shipping_tracking_code": "9400111699000410247149",
    "shipping_tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075","shipping_carrier": "USPS",
    "shipping_note": "","shipping_notification_date": 1497272330,
    "shipments": [{
            "receipt_shipping_id": 156098400075,"mailing_date": 1497272330,"carrier_name": "USPS","tracking_code": "9400111699000410247149",
            "major_tracking_state": "Shipped","current_step": "shipped","current_step_date": null,"mail_class": null,"buyer_note": "",
            "notification_date": 1497272330,"is_local_delivery": false,"local_delivery_id": null,
            "tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075?mutv=0kO99U8dkMV3SlSs86OAJU-dfFfe7AOj7xxUqYAIAzGeAuZkqAdx4Ppr7TL6Ajhia2jl4S8hOk6UH70w2pa3ptu_V-abDGON-3lQ27WKPhhksfw1F1u0F8Wr7Atpd6PrwR"
        }],
    "has_local_delivery": false,
    "shipping_details": {"can_mark_as_shipped": false,"was_shipped": true,"is_future_shipment": false,"shipment_date": 1497272330,"not_shipped_state_display": "Not Shipped",
        "has_upgrade": true,"upgrade_name": "USPS First Class Package Services","shipping_method": "USPS First Class Package Services"},
    "transparent_price_message": "","show_channel_badge": false,"channel_badge_suffix_string": "",
    "transactions": [{
            "transaction_id": 1283842164,
            "title":"Boss Lady Pen Set, Motivational Pen, Gift for Her, Gift for Boss, Boss Lady, Girl Boss, Pen Set, Inspirational Pens, Ink, Desk Accessories",
            "seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,"paid_tsz": 1497245327,
            "shipped_tsz": 1497272330,"price": "15.00","currency_code": "USD","quantity": 1,"image_listing_id": 1208449139,
            "receipt_id": 1203151258,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 399585557,
            "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
            "url": "https:\/\/www.etsy.com\/transaction\/1283842164",
            "variations": [],
            "product_data": {"product_id": 38571872,"sku": "SQ8706169","property_values": [],
                "offerings": [{"offering_id": 39261095,
                        "price": {"amount": 1500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD",
                            "currency_formatted_raw": "15.00"},
                        "quantity": 121,"is_enabled": 1,"is_deleted": 0}
                    ],
                    "is_deleted": 0
                }
            }
        ]
}

var basicPayment = {
  "receipt_id": 1203151258,"receipt_type": 0,"order_id": 511556738,"seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,
  "last_modified_tsz": 1497272330,"name": "Robin Ferragamo","first_line": "Robin","second_line": "47 Claradon Lane","city": "Staten Island",
  "state": "NY","zip": "10305","country_id": 209,"payment_method": "cc","payment_email": "","message_from_buyer": null,"was_paid": true,
  "total_tax_cost": "0.00","total_vat_cost": "0.00","total_price": "70.00","total_shipping_cost": "2.99","currency_code": "USD","message_from_payment": null,
  "was_shipped": true,"buyer_email": "vvinrobali@aol.com","seller_email": "melissa@sweetwaterdecor.com","discount_amt": "0.00","subtotal": "70.00",
  "grandtotal": "72.99","adjusted_grandtotal": "72.99","shipping_tracking_code": "9400111699000410247149",
  "shipping_tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075","shipping_carrier": "USPS",
  "shipping_note": "","shipping_notification_date": 1497272330,
  "shipments": [{
          "receipt_shipping_id": 156098400075,"mailing_date": 1497272330,"carrier_name": "USPS","tracking_code": "9400111699000410247149",
          "major_tracking_state": "Shipped","current_step": "shipped","current_step_date": null,"mail_class": null,"buyer_note": "",
          "notification_date": 1497272330,"is_local_delivery": false,"local_delivery_id": null,
          "tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075?mutv=0kO99U8dkMV3SlSs86OAJU-dfFfe7AOj7xxUqYAIAzGeAuZkqAdx4Ppr7TL6Ajhia2jl4S8hOk6UH70w2pa3ptu_V-abDGON-3lQ27WKPhhksfw1F1u0F8Wr7Atpd6PrwR"
      }],
  "has_local_delivery": false,
  "shipping_details": {"can_mark_as_shipped": false,"was_shipped": true,"is_future_shipment": false,"shipment_date": 1497272330,"not_shipped_state_display": "Not Shipped",
      "has_upgrade": true,"upgrade_name": "USPS First Class Package Services","shipping_method": "USPS First Class Package Services"},
  "transparent_price_message": "","show_channel_badge": false,"channel_badge_suffix_string": "",
  "transactions": [{
          "transaction_id": 1283842164,
          "title":"Boss Lady Pen Set",
          "seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,"paid_tsz": 1497245327,
          "shipped_tsz": 1497272330,"price": "15.00","currency_code": "USD","quantity": 1,"image_listing_id": 1208449139,
          "receipt_id": 1203151258,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 399585557,
          "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
          "url": "https:\/\/www.etsy.com\/transaction\/1283842164",
          "variations": [],
          "product_data": {"product_id": 38571872,"sku": "99012","property_values": [],
              "offerings": [{"offering_id": 39261095,
                      "price": {"amount": 1500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD",
                          "currency_formatted_raw": "15.00"},
                      "quantity": 121,"is_enabled": 1,"is_deleted": 0}
                  ],
                  "is_deleted": 0
              }
          },{
          "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book",
          "seller_user_id": 29897567,"buyer_user_id": 110067200,"creation_tsz": 1496758379,"paid_tsz": 1496758394,
          "shipped_tsz": null,"price": "55.00","currency_code": "USD","quantity": 1,"image_listing_id": 1202700319,
          "receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 502938896,
          "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
          "url": "https:\/\/www.etsy.com\/transaction\/1293312015",
          "variations": [{"property_id": 510,"value_id": 55615622348,"formatted_name": "Style","formatted_value": "Large"}],
          "product_data": {"product_id": 1069080711,"sku": "99010",
              "property_values": [{"property_id": 510,"property_name": "Style","scale_id": null,"scale_name": null,
                "value_ids": [3020298485],
                "values": ["Large"]}],
              "offerings": [{"offering_id": 1250026666,
                      "price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD",
                          "currency_formatted_raw": "55.00"},
                      "quantity": 474,"is_enabled": 1,"is_deleted": 0}
              ],
              "is_deleted": 0
          }
      },{
          "transaction_id": 1295333899,
          "title": "Imperfect \/ Sample Mint Boss Lady Coffee Mug",
          "seller_user_id": 29897567,"buyer_user_id": 115435195,"creation_tsz": 1497233018,"paid_tsz": 1497233041,"shipped_tsz": 1497272279,
          "price": "8.00","currency_code": "USD","quantity": 1,"image_listing_id": 1120572391,"receipt_id": 1203112008,"shipping_cost": "0.00",
          "is_digital": false,"file_data": "","listing_id": 99011,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,
          "transaction_type": "listing","url": "https:\/\/www.etsy.com\/transaction\/1295333899",
          "variations": [],"product_data": {
              "product_id": 40761311,"sku": "","property_values": [],
              "offerings": [{
                      "offering_id": 40572586,"price": {"amount": 800,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$8.00",
                          "currency_formatted_long": "$8.00 USD","currency_formatted_raw": "8.00"},
                      "quantity": 104,"is_enabled": 1,"is_deleted": 0}
              ],
              "is_deleted": 0
          }
      }
  ]
}


var multipleTransactions = {
    "receipt_id": 1203151258,"receipt_type": 0,"order_id": 511556738,"seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,
    "last_modified_tsz": 1497272330,"name": "Robin Ferragamo","first_line": "Robin","second_line": "47 Claradon Lane","city": "Staten Island",
    "state": "NY","zip": "10305","country_id": 209,"payment_method": "cc","payment_email": "","message_from_buyer": null,"was_paid": true,
    "total_tax_cost": "0.00","total_vat_cost": "0.00","total_price": "70.00","total_shipping_cost": "2.99","currency_code": "USD","message_from_payment": null,
    "was_shipped": true,"buyer_email": "vvinrobali@aol.com","seller_email": "melissa@sweetwaterdecor.com","discount_amt": "0.00","subtotal": "70.00",
    "grandtotal": "72.99","adjusted_grandtotal": "72.99","shipping_tracking_code": "9400111699000410247149",
    "shipping_tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075","shipping_carrier": "",
    "shipping_note": "","shipping_notification_date": 1497272330,
    "shipments": [{
            "receipt_shipping_id": 156098400075,"mailing_date": 1497272330,"carrier_name": "USPS","tracking_code": "9400111699000410247149",
            "major_tracking_state": "Shipped","current_step": "shipped","current_step_date": null,"mail_class": null,"buyer_note": "",
            "notification_date": 1497272330,"is_local_delivery": false,"local_delivery_id": null,
            "tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075?mutv=0kO99U8dkMV3SlSs86OAJU-dfFfe7AOj7xxUqYAIAzGeAuZkqAdx4Ppr7TL6Ajhia2jl4S8hOk6UH70w2pa3ptu_V-abDGON-3lQ27WKPhhksfw1F1u0F8Wr7Atpd6PrwR"
        }],
    "has_local_delivery": false,
    "shipping_details": {"can_mark_as_shipped": false,"was_shipped": true,"is_future_shipment": false,"shipment_date": 1497272330,"not_shipped_state_display": "Not Shipped",
        "has_upgrade": true,"upgrade_name": "USPS First Class Package Services","shipping_method": "USPS First Class Package Services"},
    "transparent_price_message": "","show_channel_badge": false,"channel_badge_suffix_string": "",
    "transactions": [{
            "transaction_id": 1283842164,
            "title":"Boss Lady Pen Set",
            "seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,"paid_tsz": 1497245327,
            "shipped_tsz": 1497272330,"price": "15.00","currency_code": "USD","quantity": 1,"image_listing_id": 1208449139,
            "receipt_id": 1203151258,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 399585557,
            "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
            "url": "https:\/\/www.etsy.com\/transaction\/1283842164",
            "variations": [],
            "product_data": {"product_id": 38571872,"sku": "SQ8706169","property_values": [],
                "offerings": [{"offering_id": 39261095,
                        "price": {"amount": 1500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD",
                            "currency_formatted_raw": "15.00"},
                        "quantity": 121,"is_enabled": 1,"is_deleted": 0}
                    ],
                    "is_deleted": 0
                }
            },{
            "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book",
            "seller_user_id": 29897567,"buyer_user_id": 110067200,"creation_tsz": 1496758379,"paid_tsz": 1496758394,
            "shipped_tsz": null,"price": "55.00","currency_code": "USD","quantity": 1,"image_listing_id": 1202700319,
            "receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 502938896,
            "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
            "url": "https:\/\/www.etsy.com\/transaction\/1293312015",
            "variations": [{"property_id": 510,"value_id": 55615622348,"formatted_name": "Style","formatted_value": "Large"}],
            "product_data": {"product_id": 1069080711,"sku": "Wedding Guestbook",
                "property_values": [{"property_id": 510,"property_name": "Style","scale_id": null,"scale_name": null,
                  "value_ids": [3020298485],
                  "values": ["Large"]}],
                "offerings": [{"offering_id": 1250026666,
                        "price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD",
                            "currency_formatted_raw": "55.00"},
                        "quantity": 474,"is_enabled": 1,"is_deleted": 0}
                ],
                "is_deleted": 0
            }
        },{
            "transaction_id": 1295333899,
            "title": "Imperfect \/ Sample Mint Boss Lady Coffee Mug",
            "seller_user_id": 29897567,"buyer_user_id": 115435195,"creation_tsz": 1497233018,"paid_tsz": 1497233041,"shipped_tsz": 1497272279,
            "price": "8.00","currency_code": "USD","quantity": 1,"image_listing_id": 1120572391,"receipt_id": 1203112008,"shipping_cost": "0.00",
            "is_digital": false,"file_data": "","listing_id": 250958729,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,
            "transaction_type": "listing","url": "https:\/\/www.etsy.com\/transaction\/1295333899",
            "variations": [],"product_data": {
                "product_id": 40761311,"sku": "","property_values": [],
                "offerings": [{
                        "offering_id": 40572586,"price": {"amount": 800,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$8.00",
                            "currency_formatted_long": "$8.00 USD","currency_formatted_raw": "8.00"},
                        "quantity": 104,"is_enabled": 1,"is_deleted": 0}
                ],
                "is_deleted": 0
            }
        }
    ]
}

var shippingPending = {
  "receipt_id": 1201564610,"receipt_type": 0,"order_id": 529652307,"seller_user_id": 29897567,"buyer_user_id": 110067200,"creation_tsz": 1496758379,
  "last_modified_tsz": 1496758394,"name": "Keisha Sewell","first_line": "4290 NW 34th Way","second_line": "","city": "Lauderdale Lakes","state": "FL",
  "zip": "33309","country_id": 209,"payment_method": "cc","payment_email": "",
  "was_paid": true,"total_tax_cost": "0.00","total_vat_cost": "0.00","total_price": "55.00","total_shipping_cost": "10.00","currency_code": "USD",
  "message_from_payment": null,"was_shipped": false,"buyer_email": "mskeishas646@gmail.com","seller_email": "melissa@sweetwaterdecor.com",
  "discount_amt": "0.00","subtotal": "55.00","grandtotal": "65.00","adjusted_grandtotal": "65.00","shipping_tracking_code": null,
  "shipping_tracking_url": null,"shipping_carrier": null,"shipping_note": null,"shipping_notification_date": null,
  "shipments": [],"has_local_delivery": false,
  "shipping_details": {"can_mark_as_shipped": true,"was_shipped": false,"is_future_shipment": true,"not_shipped_state_display": "Not Shipped",
      "shipping_method": "Standard Shipping"},
  "transparent_price_message": "","show_channel_badge": false,"channel_badge_suffix_string": "",
  "transactions": [{
          "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book",
      "seller_user_id": 29897567,"buyer_user_id": 110067200,"creation_tsz": 1496758379,"paid_tsz": 1496758394,"shipped_tsz": null,
      "price": "55.00","currency_code": "USD","quantity": 1,"image_listing_id": 1202700319,"receipt_id": 1201564610,"shipping_cost": "0.00",
      "is_digital": false,"file_data": "","listing_id": 502938896,"is_quick_sale": false,
      "seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing","url": "https:\/\/www.etsy.com\/transaction\/1293312015",
      "variations": [{"property_id": 510,"value_id": 55615622348,"formatted_name": "Style","formatted_value": "Large"}],
      "product_data": {
          "product_id": 1069080711,"sku": "99012",
          "property_values": [{"property_id": 510,"property_name": "Style","scale_id": null,"scale_name": null,
                  "value_ids": [3020298485],
                  "values": ["Large"]}],
          "offerings": [{
                  "offering_id": 1250026666,
                  "price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00",
                      "currency_formatted_long": "$55.00 USD","currency_formatted_raw": "55.00"},
                  "quantity": 474,"is_enabled": 1,"is_deleted": 0}],
          "is_deleted": 0
      }
    }
  ]
}

function makePayment(payment, o) {
  return _.assign({}, payment, o)
}

runTestsWithJsAndCppCollection(function() { describe('main', function() {
  var importConfiguration, results, m

  beforeEach(function() {
    results = {
    connection:{
      connectionUrl:['/conn/10001'],
      connectionId:['10001'],
      name:['Etsy Sku'],
      integrationOptions:[{productStoreUrl:'/psu/149'}],
    },
    configuration:{
      facilityUrlDefault:'/fac/1001',
      partyUrlDefault:'/pg/10001',
      invoice:'##createinvoice',
      productPromoUrlProcessing:'##noimport',
      timezone:"",
      productPromoUrlTax : '##unspecified',
      productPromoUrlDiscounts:'##unspecified',
      productPromoUrlShippingCost:'##unspecified',
      sourceDefault:{invoice: "##createinvoice", shipment: "##magazine", facilityUrl: "/fac/1001", facilityUrlLocation: null}
    },
    partygroup:TEST.finaleApiFakeData.partygroup(),
    productpromo:TEST.finaleApiFakeData.productPromo({
		name:['Promotion 1','Shipping 2','Tax 3'],
		statusId:['PROD_PRMO_ACTIVE', 'PROD_PRMO_ACTIVE', 'PROD_PRMO_ACTIVE'],
		productPromoTypeId: ['SALES_ORDER', 'SALES_ORDER', 'SALES_ORDER'],
		ruleList:[[{productPromoRuleUrl:'/ppru/103', statusId:'PRD_PRM_RUL_ACTIVE', actionEnumId:'PROMO_ORDER_AMOUNT', amount:-10}],
                	  [{productPromoRuleUrl:'/ppru/102', statusId:'PRD_PRM_RUL_ACTIVE', actionEnumId:'PROMO_ORDER_AMOUNT', amount:3.00}],
	                  [{productPromoRuleUrl:'/ppru/101', statusId:'PRD_PRM_RUL_ACTIVE', actionEnumId:'PROMO_ORDER_AMOUNT', amount:29.00}]
			 ]
    }),
    order:TEST.finaleApiFakeData.order({
      orderId:'891 Kl123c199klqZZ012Jfaslk 893 894'.w(),
      userFieldDataList:[[],[{attrName:'integration_etsysku_10001', attrValue:'HASH_2641 Kl123c199klqZZ012Jfaslk 1500586325'}],[],[]],
    }),
    product:TEST.finaleApiFakeData.product({productAssocList:[null,
     [{productAssocTypeId:'OTHER',productAssocUrl:'/pa/100',productAssocItemList:[{productUrl:'/p/99010',quantity:1}]},
      {productAssocTypeId:'MANUF_COMPONENT',productAssocUrl:'/pa/101',productAssocItemList:[{productUrl:'/p/99010',quantity:5},{productUrl:'/p/99012',quantity:1}]},
      {productAssocTypeId:'MANUF_COMPONENT',productAssocUrl:'/pa/102',productAssocItemList:[{productUrl:'/p/99011',quantity:8}]}], null]}),
    scanlookup:TEST.finaleApiFakeData.scanLookup(), 
    facility:TEST.finaleApiFakeData.facility(),
    configurationData:{
        "countries":[{"country_id":209,"iso_country_code":"US","world_bank_country_code":"USA","name":"United States","slug":"united-states","lat":39.83333,"lon":-98.58333},{"country_id":122,"iso_country_code":"IN","world_bank_country_code":"IND","name":"India","slug":"india","lat":22.93,"lon":79.81}],
    }
    }
    m = etsysku.moduleForConnectionId('10001')
    u.unixTimestampMillisecondsTestResult = 1500586325000
  })

  it('empty entity returns null', function() {
    expect(m.importConfiguration().importEntity(results, {})).toBe(null)
  })
  
  it('unit tests for base function', function() {
    expect(m.insertUpdateForOrder(paymentNoMatching))
      .toEqual({externalId:'etsysku_order_10001_1203151258', metaData:'completed', description:'1203151258',objectData:{order:paymentNoMatching}})

    expect(m.insertUpdateForOrder(shippingPending))
      .toEqual({externalId:'etsysku_order_10001_1201564610', metaData:'committed', description:'1201564610',objectData:{order:shippingPending}})

    expect(m.orderIdForExternalId('etsysku_order_10001_1203151258')).toBe('1203151258')
    expect(m.externalIdForUserFieldAttrValue('HASH_5442 1203151258 1500586325')).toBe('etsysku_order_10001_1203151258')
  })

  it('prefetch interface', function() {
    var paymentList = [
        {"receipt_id":1203151258,"receipt_type":0,"order_id":511556738,"seller_user_id":29897567,"buyer_user_id":30001473,
            "creation_tsz":1497245307,"last_modified_tsz":1497272330,"name":"Robin Ferragamo","first_line":"Robin",
            "second_line":"47 Claradon Lane","city":"Staten Island","state":"NY","zip":"10305","country_id":209,
            "payment_method":"cc","payment_email":"","message_from_buyer":null,"was_paid":true,"total_tax_cost":"0.00","total_vat_cost":"0.00",
            "total_price":"15.00","total_shipping_cost":"2.99","currency_code":"USD","message_from_payment":null,"was_shipped":true,
            "buyer_email":"vvinrobali@aol.com","seller_email":"melissa@sweetwaterdecor.com","discount_amt":"0.00","subtotal":"15.00",
            "grandtotal":"17.99","adjusted_grandtotal":"17.99","shipping_tracking_code":"9400111699000410247149",
            "shipping_tracking_url":"https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075","shipping_carrier":"USPS",
            "shipping_note":"","shipping_notification_date":1497272330,
            "shipments":[{"receipt_shipping_id":156098400075,"mailing_date":1497272330,"carrier_name":"USPS","tracking_code":"9400111699000410247149",
                    "major_tracking_state":"Shipped","current_step":"shipped","current_step_date":null,"mail_class":null,"buyer_note":"",
                    "notification_date":1497272330,"is_local_delivery":false,"local_delivery_id":null,
                    "tracking_url":"https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075?mutv=0kO99U8dkMV3SlSs86OAJU-dfFfe7AOj7xxUqYAIAzGeAuZkqAdx4Ppr7TL6Ajhia2jl4S8hOk6UH70w2pa3ptu_V-abDGON-3lQ27WKPhhksfw1F1u0F8Wr7Atpd6PrwR"}],
            "has_local_delivery":false,
            "shipping_details":{"can_mark_as_shipped":false,"was_shipped":true,"is_future_shipment":false,"shipment_date":1497272330,
                "not_shipped_state_display":"Not Shipped","has_upgrade":true,"upgrade_name":"USPS First Class Package Services",
                "shipping_method":"USPS First Class Package Services"},
            "transparent_price_message":"","show_channel_badge":false,"channel_badge_suffix_string":"",
            "transactions":[{
                    "transaction_id":1283842164,
                    "title": "Boss Lady Pen Set, Motivational Pen, Gift for Her, Gift for Boss, Boss Lady, Girl Boss, Pen Set, Inspirational Pens, Ink, Desk Accessories",
                    "seller_user_id":29897567,"buyer_user_id":30001473,"creation_tsz":1497245307,"paid_tsz":1497245327,
                    "shipped_tsz":1497272330,"price":"15.00","currency_code":"USD","quantity":1,
                    "materials":[],"image_listing_id":1208449139,"receipt_id":1203151258,"shipping_cost":"0.00","is_digital":false,
                    "file_data":"","listing_id":399585557,"is_quick_sale":false,"seller_feedback_id":null,
                    "buyer_feedback_id":null,"transaction_type":"listing","url":"https:\/\/www.etsy.com\/transaction\/1283842164",
                    "variations":[],
                    "product_data":{
                        "product_id":38571872,"sku":"SQ8706169","property_values":[],
                        "offerings":[{"offering_id":39261095,
                                "price":{"amount":1500,"divisor":100,"currency_code":"USD","currency_formatted_short":"$15.00",
                                    "currency_formatted_long":"$15.00 USD","currency_formatted_raw":"15.00"},
                                "quantity":121,"is_enabled":1,"is_deleted":0}],
                        "is_deleted":0}}
            ]},
        {"receipt_id":1203112008,"receipt_type":0,"order_id":511517592,"seller_user_id":29897567,"buyer_user_id":115435195,
            "creation_tsz":1497233018,"last_modified_tsz":1497272279,"name":"Abbi Rowe","first_line":"4245 Enders St.",
            "second_line":"#203","city":"Orlando","state":"FL","zip":"32814","country_id":209,"payment_method":"cc","payment_email":"",
            "message_from_buyer":null,"was_paid":true,"total_tax_cost":"0.00","total_vat_cost":"0.00","total_price":"8.00",
            "total_shipping_cost":"4.99","currency_code":"USD","message_from_payment":null,"was_shipped":true,
            "buyer_email":"abbi.thomason@live.mercer.edu","seller_email":"melissa@sweetwaterdecor.com","discount_amt":"0.00","subtotal":"8.00",
            "grandtotal":"12.99","adjusted_grandtotal":"12.99","shipping_tracking_code":"9400111699000410243233",
            "shipping_tracking_url":"https:\/\/www.etsy.com\/your\/orders\/1203112008\/order_tracking\/152730071158","shipping_carrier":"USPS",
            "shipping_note":"","shipping_notification_date":1497272279,
            "shipments":[{"receipt_shipping_id":152730071158,"mailing_date":1497272279,"carrier_name":"USPS",
                    "tracking_code":"9400111699000410243233","major_tracking_state":"Shipped","current_step":"shipped",
                    "current_step_date":null,"mail_class":null,"buyer_note":"","notification_date":1497272279,"is_local_delivery":false,
                    "local_delivery_id":null,"tracking_url":"https:\/\/www.etsy.com\/your\/orders\/1203112008\/order_tracking\/152730071158?mutv=0kf3LrASjxyEcRdndYnaNfLNcqUMyVzUvz0GTVwXMoz0nRYoe8xKH2Ajt44clhmMDqEs-yVdbZtbHBH19jJ6Lufacz-mAuO_QXa9RxBotHIE7haSzmD8OA0jAYlPZ2ZbUL"}],
            "has_local_delivery":false,"shipping_details":{"can_mark_as_shipped":false,"was_shipped":true,"is_future_shipment":false,"shipment_date":1497272279,
                "not_shipped_state_display":"Not Shipped","has_upgrade":true,"upgrade_name":"USPS First Class Package Services",
                "shipping_method":"USPS First Class Package Services"},
            "transparent_price_message":"","show_channel_badge":false,"channel_badge_suffix_string":"",
            "transactions":[{
                    "transaction_id":1295333899,"title": "Imperfect \/ Sample Mint Boss Lady Coffee Mug, Coffee Mugs, Boss Lady, Motivational Mug, Inspirational Coffee Mug, Coffee Cup, Coffee Mug",
                    "seller_user_id":29897567,"buyer_user_id":115435195,"creation_tsz":1497233018,
                    "paid_tsz":1497233041,"shipped_tsz":1497272279,"price":"8.00","currency_code":"USD","quantity":1,
                    "materials":["11oz_ceramic_mug"],"image_listing_id":1120572391,"receipt_id":1203112008,"shipping_cost":"0.00","is_digital":false,"file_data":"",
                    "listing_id":250958729,"is_quick_sale":false,"seller_feedback_id":null,"buyer_feedback_id":null,
                    "transaction_type":"listing","url":"https:\/\/www.etsy.com\/transaction\/1295333899","variations":[],
                    "product_data":{"product_id":40761311,"sku":"","property_values":[],
                        "offerings":[{"offering_id":40572586,"price":{"amount":800,"divisor":100,"currency_code":"USD","currency_formatted_short":"$8.00",
                                    "currency_formatted_long":"$8.00 USD","currency_formatted_raw":"8.00"},
                                "quantity":104,"is_enabled":1,"is_deleted":0}],"is_deleted":0}}]},
        {"receipt_id":1208668109,"receipt_type":0,"order_id":511463096,"seller_user_id":29897567,"buyer_user_id":111194768,"creation_tsz":1497220143,
            "last_modified_tsz":1497272236,"name":"Zachery Granstrom","first_line":"4047 Heritage Ave E",
            "second_line":null,"city":"Fife","state":"WA","zip":"98424","country_id":209,"payment_method":"cc","payment_email":"",
            "message_from_buyer":null,"was_paid":true,"total_tax_cost":"0.00","total_vat_cost":"0.00","total_price":"5.00",
            "total_shipping_cost":"2.99","currency_code":"USD","message_from_payment":null,"was_shipped":true,
            "buyer_email":"zacherygranstrom@yahoo.com","seller_email":"melissa@sweetwaterdecor.com","discount_amt":"0.00",
            "subtotal":"5.00","grandtotal":"7.99","adjusted_grandtotal":"7.99","shipping_tracking_code":"9400111699000410212628",
            "shipping_tracking_url":"https:\/\/www.etsy.com\/your\/orders\/1208668109\/order_tracking\/152729727388","shipping_carrier":"USPS",
            "shipping_note":"","shipping_notification_date":1497272236,
            "shipments":[{"receipt_shipping_id":152729727388,"mailing_date":1497272236,"carrier_name":"USPS","tracking_code":"9400111699000410212628",
                    "major_tracking_state":"Shipped","current_step":"shipped","current_step_date":null,"mail_class":null,"buyer_note":"",
                    "notification_date":1497272236,"is_local_delivery":false,"local_delivery_id":null,
                    "tracking_url":"https:\/\/www.etsy.com\/your\/orders\/1208668109\/order_tracking\/152729727388?mutv=0ka03UYpj7RRCuLo4uAmgXE-rMCCGTYjw0fXTBMh4BnmTFotUQCvNZ0hMf9dhxWkxAeNeb8anHB_W9sGUyXX3Hi0RQkbJL_C8pYTiKtQOPrxVsraYYnCdmDIwWPrsr_ENM"}],
            "has_local_delivery":false,
            "shipping_details":{"can_mark_as_shipped":false,"was_shipped":true,
                "is_future_shipment":false,"shipment_date":1497272236,"not_shipped_state_display":"Not Shipped","has_upgrade":true,
                "upgrade_name":"USPS First Class Package Services","shipping_method":"USPS First Class Package Services"},
            "transparent_price_message":"","show_channel_badge":false,"channel_badge_suffix_string":"",
            "transactions":[
                {"transaction_id":1283712878,
                    "title":"But First Coffee Pen, Motivational Pen, Gift for Her, Gift for Boss, Boss Lady, Girl Boss, Inspirational Pens, Ink Pen, Desk, Office, Black",
                    "seller_user_id":29897567,"buyer_user_id":111194768,"creation_tsz":1497220143,"paid_tsz":1497220163,"shipped_tsz":1497272236,"price":"5.00",
                    "currency_code":"USD","quantity":1,
                    "materials":[],"image_listing_id":1208457439,"receipt_id":1208668109,"shipping_cost":"0.00","is_digital":false,"file_data":"",
                    "listing_id":495547862,"is_quick_sale":false,"seller_feedback_id":null,"buyer_feedback_id":null,"transaction_type":"listing",
                    "url":"https:\/\/www.etsy.com\/transaction\/1283712878","variations":[],
                    "product_data":{"product_id":42839915,"sku":"SQ8701174","property_values":[],
                        "offerings":[{"offering_id":42656402,"price":{"amount":500,"divisor":100,"currency_code":"USD",
                                    "currency_formatted_short":"$5.00","currency_formatted_long":"$5.00 USD","currency_formatted_raw":"5.00"},
                                "quantity":159,"is_enabled":1,"is_deleted":0}],"is_deleted":0}}]}
        
      ]

    expect(m.productIdOrScanKeyListForOrderList(paymentList)).toEqual('250958729 SQ8701174 SQ8706169'.w())
    expect(m.orderIdListForOrderList(results, paymentList)).toEqual(['1203112008','1203151258','1208668109'])
  })        
  
  it('basic entity no matching lookups', function() {
    expect(m.importConfiguration().importEntity(results, _.cloneDeep(multipleTransactions))).toEqual({
      syncStatus:'##ready',
      entity:multipleTransactions,
      entityId:'1203151258',
      userField:{attrName:'integration_etsysku_10001',attrValue:'HASH_615C 1203151258 1500586325'},
      warnings:[
        {"msg":"No product lookup for","scanLookupScanKey":"SQ8706169","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":""},
        {"msg":"No product lookup for","scanLookupScanKey":"Wedding Guestbook","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":""},
        {"msg":"No product lookup for","scanLookupScanKey":"250958729","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":""},
      ],
      scanLookups:[
        {"scanLookupScanKey":"SQ8706169","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":""},
        {"scanLookupScanKey":"Wedding Guestbook","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":""},
        {"scanLookupScanKey":"250958729","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":""}
      ],
      rows:[expectedRowsHeader,
        ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,null,'SQ8706169 Boss Lady Pen Set',1,15.00,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,null,'Wedding Guestbook Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,null,'250958729 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8.00,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,
         'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            4,null,'Unnamed shipping',2.99,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
      ],
    })
  })

  it('basic entity matching lookups', function() {
    var payment = makePayment(basicPayment)
    results.configuration.expandBillOfMaterialsPolicy = '##noexpand'
    expect(m.importConfiguration().importEntity(results, _.cloneDeep(payment))).toEqual({
      syncStatus:'##ready',
      entity:payment,
      entityId:'1203151258',
      userField:{attrName:'integration_etsysku_10001',attrValue:'HASH_A7D9 1203151258 1500586325'},
      warnings:[],
      scanLookups:[
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
        {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
      ],
      rows:[expectedRowsHeader,
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',3,'99011',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROD_ITEM','99011',null,null,1,8,null,
         'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            4,null,'USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
      ],
    })
  })
  
  it('Added tax, vat tax and discount', function() {
    var payment = {
    "receipt_id": 1203151258,"receipt_type": 0,"order_id": 511556738,"seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,
    "last_modified_tsz": 1497272330,"name": "Robin Ferragamo","first_line": "Robin","second_line": "47 Claradon Lane","city": "Staten Island",
    "state": "NY","zip": "10305","country_id": 209,"payment_method": "cc","payment_email": "","message_from_buyer": null,"was_paid": true,
    "total_tax_cost": "2.00","total_vat_cost": "1.80","total_price": "70.00","total_shipping_cost": "2.99","currency_code": "USD","message_from_payment": null,
    "was_shipped": true,"buyer_email": "vvinrobali@aol.com","seller_email": "melissa@sweetwaterdecor.com","discount_amt": "5.00","subtotal": "70.00",
    "grandtotal": "72.99","adjusted_grandtotal": "72.99","shipping_tracking_code": "9400111699000410247149",
    "shipping_tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075","shipping_carrier": "USPS",
    "shipping_note": "","shipping_notification_date": 1497272330,
    "shipments": [{
            "receipt_shipping_id": 156098400075,"mailing_date": 1497272330,"carrier_name": "USPS","tracking_code": "9400111699000410247149",
            "major_tracking_state": "Shipped","current_step": "shipped","current_step_date": null,"mail_class": null,"buyer_note": "",
            "notification_date": 1497272330,"is_local_delivery": false,"local_delivery_id": null,
            "tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075?mutv=0kO99U8dkMV3SlSs86OAJU-dfFfe7AOj7xxUqYAIAzGeAuZkqAdx4Ppr7TL6Ajhia2jl4S8hOk6UH70w2pa3ptu_V-abDGON-3lQ27WKPhhksfw1F1u0F8Wr7Atpd6PrwR"
        }],
    "has_local_delivery": false,
    "shipping_details": {"can_mark_as_shipped": false,"was_shipped": true,"is_future_shipment": false,"shipment_date": 1497272330,"not_shipped_state_display": "Not Shipped",
        "has_upgrade": true,"upgrade_name": "USPS First Class Package Services","shipping_method": "USPS First Class Package Services"},
    "transparent_price_message": "","show_channel_badge": false,"channel_badge_suffix_string": "",
    "transactions": [{
            "transaction_id": 1283842164,
            "title":"Boss Lady Pen Set",
            "seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,"paid_tsz": 1497245327,
            "shipped_tsz": 1497272330,"price": "15.00","currency_code": "USD","quantity": 1,"image_listing_id": 1208449139,
            "receipt_id": 1203151258,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 399585557,
            "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
            "url": "https:\/\/www.etsy.com\/transaction\/1283842164",
            "variations": [],
            "product_data": {"product_id": 38571872,"sku": "99012","property_values": [],
                "offerings": [{"offering_id": 39261095,
                        "price": {"amount": 1500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD",
                            "currency_formatted_raw": "15.00"},
                        "quantity": 121,"is_enabled": 1,"is_deleted": 0}
                    ],
                    "is_deleted": 0
                }
            },{
            "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book",
            "seller_user_id": 29897567,"buyer_user_id": 110067200,"creation_tsz": 1496758379,"paid_tsz": 1496758394,
            "shipped_tsz": null,"price": "55.00","currency_code": "USD","quantity": 1,"image_listing_id": 1202700319,
            "receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 502938896,
            "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
            "url": "https:\/\/www.etsy.com\/transaction\/1293312015",
            "variations": [{"property_id": 510,"value_id": 55615622348,"formatted_name": "Style","formatted_value": "Large"}],
            "product_data": {"product_id": 1069080711,"sku": "99010",
                "property_values": [{"property_id": 510,"property_name": "Style","scale_id": null,"scale_name": null,
                  "value_ids": [3020298485],
                  "values": ["Large"]}],
                "offerings": [{"offering_id": 1250026666,
                        "price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD",
                            "currency_formatted_raw": "55.00"},
                        "quantity": 474,"is_enabled": 1,"is_deleted": 0}
                ],
                "is_deleted": 0
            }
        }
    ]
}

    results.configuration.expandBillOfMaterialsPolicy = '##noexpand'
    expect(m.importConfiguration().importEntity(results, _.cloneDeep(payment))).toEqual({
      syncStatus:'##ready',
      entity:payment,
      entityId:'1203151258',
      userField:{attrName:'integration_etsysku_10001',attrValue:'HASH_9E08 1203151258 1500586325'},
      warnings:[],
      scanLookups:[
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
      ],
      rows:[expectedRowsHeader,
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            3,null,'Discount',-5,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROMOTION_ADJ',null,'Discount',null,null,null,-5,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            4,null,'USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            5,null,'Tax',2,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',5,'INV_PROMOTION_ADJ',null,'Tax',null,null,null,2,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],    
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            6,null,'VAT',1.8,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',6,'INV_PROMOTION_ADJ',null,'VAT',null,null,null,1.8,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
      ],
    })
  })

  it('Pending shipping', function() {
    results.configuration.expandBillOfMaterialsPolicy = '##noexpand'
    expect(m.importConfiguration().importEntity(results, _.cloneDeep(shippingPending))).toEqual({
      syncStatus:'##ready',
      entity:shippingPending,
      entityId:'1201564610',
      userField:{attrName:'integration_etsysku_10001',attrValue:'HASH_AF7F 1201564610 1500586325'},
      warnings:[],
      scanLookups:[
        {"scanLookupScanKey":"99012","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99012"},
      ],
      rows:[expectedRowsHeader,
        ['SALES_ORDER','1201564610','ORDER_LOCKED','2017-06-06T07:12:59Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
         null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,
        'Keisha Sewell','4290 NW 34th Way','Lauderdale Lakes','FL','33309','USA','mskeishas646@gmail.com'],
        ['SALES_ORDER','1201564610','ORDER_LOCKED','2017-06-06T07:12:59Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            2,null,'Unnamed shipping',10,null,null,null,null,null,null,null,null,
            null,null,null,null,null,null,null,null,null,null,null,
            'Keisha Sewell','4290 NW 34th Way','Lauderdale Lakes','FL','33309','USA','mskeishas646@gmail.com'],
      ],
    })
  })

  it('verify order and shipping dates with custom timezone configuration settings', function() {
    
    var payment = makePayment(basicPayment)

    results.configuration.expandBillOfMaterialsPolicy = '##noexpand'
    results.configuration.timezone = "Asia/Kolkata"
    expect(m.importConfiguration().importEntity(results, _.cloneDeep(payment))).toEqual({
      syncStatus:'##ready',
      entity:payment,
      entityId:'1203151258',
      userField:{attrName:'integration_etsysku_10001',attrValue:'HASH_D926 1203151258 1500586325'},
      warnings:[],
      scanLookups:[
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
        {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
      ],
      rows:[expectedRowsHeader,
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-12T10:58:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T18:28:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T18:28:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-12T10:58:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T18:28:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T18:28:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-12T10:58:27Z','/fac/900','Big Parks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T18:28:50Z',3,'99011',1,'/fac/1001','1203151258-1','2017-06-12T18:28:50Z','Posted',3,'INV_PROD_ITEM','99011',null,null,1,8,null,
         'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-12T10:58:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            4,null,'USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T18:28:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T18:28:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
      ],
    })
  })
  
  it('Verify ProductPromoUrl for Tax, Discount and Shipping configuration to noimport', function() {
    var payment = {
    "receipt_id": 1203151258,"receipt_type": 0,"order_id": 511556738,"seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,
    "last_modified_tsz": 1497272330,"name": "Robin Ferragamo","first_line": "Robin","second_line": "47 Claradon Lane","city": "Staten Island",
    "state": "NY","zip": "10305","country_id": 209,"payment_method": "cc","payment_email": "","message_from_buyer": null,"was_paid": true,
    "total_tax_cost": "2.00","total_vat_cost": "1.80","total_price": "70.00","total_shipping_cost": "2.99","currency_code": "USD","message_from_payment": null,
    "was_shipped": true,"buyer_email": "vvinrobali@aol.com","seller_email": "melissa@sweetwaterdecor.com","discount_amt": "5.00","subtotal": "70.00",
    "grandtotal": "72.99","adjusted_grandtotal": "72.99","shipping_tracking_code": "9400111699000410247149",
    "shipping_tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075","shipping_carrier": "USPS",
    "shipping_note": "","shipping_notification_date": 1497272330,
    "shipments": [{
            "receipt_shipping_id": 156098400075,"mailing_date": 1497272330,"carrier_name": "USPS","tracking_code": "9400111699000410247149",
            "major_tracking_state": "Shipped","current_step": "shipped","current_step_date": null,"mail_class": null,"buyer_note": "",
            "notification_date": 1497272330,"is_local_delivery": false,"local_delivery_id": null,
            "tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075?mutv=0kO99U8dkMV3SlSs86OAJU-dfFfe7AOj7xxUqYAIAzGeAuZkqAdx4Ppr7TL6Ajhia2jl4S8hOk6UH70w2pa3ptu_V-abDGON-3lQ27WKPhhksfw1F1u0F8Wr7Atpd6PrwR"
        }],
    "has_local_delivery": false,
    "shipping_details": {"can_mark_as_shipped": false,"was_shipped": true,"is_future_shipment": false,"shipment_date": 1497272330,"not_shipped_state_display": "Not Shipped",
        "has_upgrade": true,"upgrade_name": "USPS First Class Package Services","shipping_method": "USPS First Class Package Services"},
    "transparent_price_message": "","show_channel_badge": false,"channel_badge_suffix_string": "",
    "transactions": [{
            "transaction_id": 1283842164,
            "title":"Boss Lady Pen Set",
            "seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,"paid_tsz": 1497245327,
            "shipped_tsz": 1497272330,"price": "15.00","currency_code": "USD","quantity": 1,"image_listing_id": 1208449139,
            "receipt_id": 1203151258,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 399585557,
            "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
            "url": "https:\/\/www.etsy.com\/transaction\/1283842164",
            "variations": [],
            "product_data": {"product_id": 38571872,"sku": "99012","property_values": [],
                "offerings": [{"offering_id": 39261095,
                        "price": {"amount": 1500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD",
                            "currency_formatted_raw": "15.00"},
                        "quantity": 121,"is_enabled": 1,"is_deleted": 0}
                    ],
                    "is_deleted": 0
                }
            },{
            "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book",
            "seller_user_id": 29897567,"buyer_user_id": 110067200,"creation_tsz": 1496758379,"paid_tsz": 1496758394,
            "shipped_tsz": null,"price": "55.00","currency_code": "USD","quantity": 1,"image_listing_id": 1202700319,
            "receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 502938896,
            "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
            "url": "https:\/\/www.etsy.com\/transaction\/1293312015",
            "variations": [{"property_id": 510,"value_id": 55615622348,"formatted_name": "Style","formatted_value": "Large"}],
            "product_data": {"product_id": 1069080711,"sku": "99010",
                "property_values": [{"property_id": 510,"property_name": "Style","scale_id": null,"scale_name": null,
                  "value_ids": [3020298485],
                  "values": ["Large"]}],
                "offerings": [{"offering_id": 1250026666,
                        "price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD",
                            "currency_formatted_raw": "55.00"},
                        "quantity": 474,"is_enabled": 1,"is_deleted": 0}
                ],
                "is_deleted": 0
            }
        }
    ]
}
    results.configuration.productPromoUrlTax = '##noimport'
    results.configuration.productPromoUrlShippingCost = '##noimport'
    results.configuration.productPromoUrlDiscount = '##noimport'    	
    results.configuration.expandBillOfMaterialsPolicy = '##noexpand'

    var imported = m.importConfiguration().importEntity(results, _.cloneDeep(payment))
    expect(imported.syncStatus).toEqual('##ready')
    expect(imported.entity).toEqual(payment)
    expect(imported.entityId).toEqual('1203151258')
    expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_5540 1203151258 1500586325'})
    expect(imported.warnings).toEqual([])
    expect(imported.scanLookups).toEqual([
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
      ])
    expect(imported.rows.length).toEqual(3)
    expect(imported.rows[0]).toEqual(expectedRowsHeader)
    expect(imported.rows[1]).toEqual( ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
    expect(imported.rows[2]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
  })

  it('Verify ProductPromoUrl for Tax, Discount and Shipping configuration to matching values', function() {
    var payment = {
    "receipt_id": 1203151258,"receipt_type": 0,"order_id": 511556738,"seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,
    "last_modified_tsz": 1497272330,"name": "Robin Ferragamo","first_line": "Robin","second_line": "47 Claradon Lane","city": "Staten Island",
    "state": "NY","zip": "10305","country_id": 209,"payment_method": "cc","payment_email": "","message_from_buyer": null,"was_paid": true,
    "total_tax_cost": "2.00","total_vat_cost": "1.80","total_price": "70.00","total_shipping_cost": "2.99","currency_code": "USD","message_from_payment": null,
    "was_shipped": true,"buyer_email": "vvinrobali@aol.com","seller_email": "melissa@sweetwaterdecor.com","discount_amt": "5.00","subtotal": "70.00",
    "grandtotal": "72.99","adjusted_grandtotal": "72.99","shipping_tracking_code": "9400111699000410247149",
    "shipping_tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075","shipping_carrier": "USPS",
    "shipping_note": "","shipping_notification_date": 1497272330,
    "shipments": [{
            "receipt_shipping_id": 156098400075,"mailing_date": 1497272330,"carrier_name": "USPS","tracking_code": "9400111699000410247149",
            "major_tracking_state": "Shipped","current_step": "shipped","current_step_date": null,"mail_class": null,"buyer_note": "",
            "notification_date": 1497272330,"is_local_delivery": false,"local_delivery_id": null,
            "tracking_url": "https:\/\/www.etsy.com\/your\/orders\/1203151258\/order_tracking\/156098400075?mutv=0kO99U8dkMV3SlSs86OAJU-dfFfe7AOj7xxUqYAIAzGeAuZkqAdx4Ppr7TL6Ajhia2jl4S8hOk6UH70w2pa3ptu_V-abDGON-3lQ27WKPhhksfw1F1u0F8Wr7Atpd6PrwR"
        }],
    "has_local_delivery": false,
    "shipping_details": {"can_mark_as_shipped": false,"was_shipped": true,"is_future_shipment": false,"shipment_date": 1497272330,"not_shipped_state_display": "Not Shipped",
        "has_upgrade": true,"upgrade_name": "USPS First Class Package Services","shipping_method": "USPS First Class Package Services"},
    "transparent_price_message": "","show_channel_badge": false,"channel_badge_suffix_string": "",
    "transactions": [{
            "transaction_id": 1283842164,
            "title":"Boss Lady Pen Set",
            "seller_user_id": 29897567,"buyer_user_id": 30001473,"creation_tsz": 1497245307,"paid_tsz": 1497245327,
            "shipped_tsz": 1497272330,"price": "15.00","currency_code": "USD","quantity": 1,"image_listing_id": 1208449139,
            "receipt_id": 1203151258,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 399585557,
            "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
            "url": "https:\/\/www.etsy.com\/transaction\/1283842164",
            "variations": [],
            "product_data": {"product_id": 38571872,"sku": "99012","property_values": [],
                "offerings": [{"offering_id": 39261095,
                        "price": {"amount": 1500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD",
                            "currency_formatted_raw": "15.00"},
                        "quantity": 121,"is_enabled": 1,"is_deleted": 0}
                    ],
                    "is_deleted": 0
                }
            },{
            "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book",
            "seller_user_id": 29897567,"buyer_user_id": 110067200,"creation_tsz": 1496758379,"paid_tsz": 1496758394,
            "shipped_tsz": null,"price": "55.00","currency_code": "USD","quantity": 1,"image_listing_id": 1202700319,
            "receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"file_data": "","listing_id": 502938896,
            "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
            "url": "https:\/\/www.etsy.com\/transaction\/1293312015",
            "variations": [{"property_id": 510,"value_id": 55615622348,"formatted_name": "Style","formatted_value": "Large"}],
            "product_data": {"product_id": 1069080711,"sku": "99010",
                "property_values": [{"property_id": 510,"property_name": "Style","scale_id": null,"scale_name": null,
                  "value_ids": [3020298485],
                  "values": ["Large"]}],
                "offerings": [{"offering_id": 1250026666,
                        "price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD",
                            "currency_formatted_raw": "55.00"},
                        "quantity": 474,"is_enabled": 1,"is_deleted": 0}
                ],
                "is_deleted": 0
            }
        }
    ]
}
    results.configuration.productPromoUrlTax = '/ppu/127'
    results.configuration.productPromoUrlShippingCost = '/ppu/128'
    results.configuration.productPromoUrlDiscount = '/ppu/129'
    results.configuration.expandBillOfMaterialsPolicy = '##noexpand'

    var imported = m.importConfiguration().importEntity(results, _.cloneDeep(payment))
    expect(imported.syncStatus).toEqual('##ready')
    expect(imported.entity).toEqual(payment)
    expect(imported.entityId).toEqual('1203151258')
    expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_CE71 1203151258 1500586325'})
    expect(imported.warnings).toEqual([])
    expect(imported.scanLookups).toEqual([
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
      ])
    expect(imported.rows.length).toEqual(7)
    expect(imported.rows[0]).toEqual(expectedRowsHeader)
    expect(imported.rows[1]).toEqual( ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
    expect(imported.rows[2]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])

    expect(imported.rows[3]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            3,'Promotion 1','Discount',-5,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROMOTION_ADJ',null,'Discount','Promotion 1',null,null,-5,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
    expect(imported.rows[4]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            4,'Shipping 2','USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS','Shipping 2',null,null,2.99,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
    expect(imported.rows[5]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            5,'Tax 3','Tax',2,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',5,'INV_PROMOTION_ADJ',null,'Tax','Tax 3',null,null,2,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
    expect(imported.rows[6]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
            6,'Tax 3','VAT',1.8,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',6,'INV_PROMOTION_ADJ',null,'VAT','Tax 3',null,null,1.8,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])

  })


  it('Fallback to facilityUrlDefault when sourceDefault not set - backward compatibility', function() {

    var payment = makePayment(basicPayment)

  _.assign(results.configuration, { sourceDefault:null})
  results.configuration.expandBillOfMaterialsPolicy = '##noexpand'
  expect(m.importConfiguration().importEntity(results, _.cloneDeep(payment))).toEqual({
    syncStatus:'##ready',
    entity:payment,
    entityId:'1203151258',
    userField:{attrName:'integration_etsysku_10001',attrValue:'HASH_A7D9 1203151258 1500586325'},
    warnings:[],
    scanLookups:[
      {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
      {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
      {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
    ],
    rows:[expectedRowsHeader,
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
       'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
       'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8.00,null,null,null,null,
       'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',3,'99011',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROD_ITEM','99011',null,null,1,8,null,
       'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,
          4,null,'USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
          '1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
    ],
  })

})

it('does not create order when configured to no order', function() {
    var payment = multipleTransactions,imported

    results.configuration = {
      sourceDefault:{invoice: "##createinvoice", shipment: "##noorder", facilityUrl: "/fac/1001", facilityUrlLocation: "/fac/900"}
    }

    results.scanlookup = {
      scanLookupUrl:'/scanlookup/AAA /scanlookup/BBB /scanlookup/CCC'.w(),
      scanKey:'10019 10021'.w(),
      productUrl:'/p/99010 /p/99011 /p/99012'.w(),
    }

    imported = m.importConfiguration().importEntity(results, payment)

    expect(imported).toEqual(null)

  })

it('add shipment row when option set to shipment and a shipment has SHIPMENT_PACKED status', function() {

  var payment = basicPayment, imported

  results.configuration.sourceDefault={invoice: "##createinvoice", shipment: "##shipment", facilityUrlLocation: "/fac/900"}

  results.order = {orderUrl:'/dev/api/order/1850'.w(),orderId:'1203151258'.w(),shipmentUrlList:['/s/201'.w()],userFieldDataList:[
            [{attrName:'integration_etsysku_10001',attrValue:'HASH_5B98 1203151258 1500586325'}]],}

  results.shipment = {shipmentUrl:'/s/200 /s/201 /s/202'.w(),shipmentIdUser:'200 201 202'.w(),statusId:'SHIPMENT_SHIPPED SHIPMENT_PACKED SHIPMENT_SHIPPED'.w()}

  imported = m.importConfiguration().importEntity(results, payment)
  expect(imported.syncStatus).toEqual('##ready')
  expect(imported.entity).toEqual(payment)
  expect(imported.entityId).toEqual('1203151258')
  expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_AA4D 1203151258 1500586325'})
  expect(imported.scanLookups).toEqual([
      {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
      {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
      {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
  ])
  expect(imported.warnings).toEqual([])
  expect(imported.rows.length).toEqual(7)
  expect(imported.rows[0]).toEqual(expectedRowsHeaderNoShipmentItem)
  expect(imported.rows[1]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
       null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']

  )
  expect(imported.rows[2]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55,null,null,null,null,
       null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
  )
  expect(imported.rows[3]).toEqual(
    ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,'99010','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',5,0.8857142857142858,null,null,null,null,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROD_ITEM','99010',null,null,5,0.8857142857142858,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
  )
  expect(imported.rows[4]).toEqual(
    ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',4,'99012','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,3.5714285714285716,null,null,null,null,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROD_ITEM','99012',null,null,1,3.5714285714285716,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
  )
  expect(imported.rows[5]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,5,null,'USPS', 2.99,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',5,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
  )
  expect(imported.rows[6]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,null,null,null,null,'SALES_SHIPMENT','201','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
  )
})

it('does not update shipments or create warning when configured to use shipments packed in finale and shipment is already shipped', function() {

  var payment = basicPayment, imported

  results.configuration = {
    facilityUrlDefault:'/fac/1001',
    partyUrlDefault:'/pg/10001',
    invoice:'##createinvoice',
    productPromoUrlProcessing:'##unspecified',
    expandBillOfMaterialsPolicy:'##noexpand',
    sourceDefault:{invoice: "##createinvoice", shipment: "##shipment", facilityUrlLocation: "/fac/900"}
  }

   results.order = {orderUrl:'/dev/api/order/2894'.w(),orderId:'1203151258'.w(),shipmentUrlList:['/s/200'.w()],userFieldDataList:[
        [{attrName:'integration_etsysku_10001',attrValue:'HASH_ABCD 1203151258 1500586325'}]],}

   results.shipment = {shipmentUrl:'/s/200 /s/201 /s/202'.w(),shipmentIdUser:'200 201 202'.w(),statusId:'SHIPMENT_SHIPPED SHIPMENT_PACKED SHIPMENT_SHIPPED'.w()}

    imported = m.importConfiguration().importEntity(results, payment)
    expect(imported.syncStatus).toEqual('##ready')
    expect(imported.entity).toEqual(payment)
    expect(imported.entityId).toEqual('1203151258')
    expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_4AE4 1203151258 1500586325'})
    expect(imported.scanLookups).toEqual([
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
        {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
    ])
    expect(imported.warnings).toEqual([])
    expect(imported.rows.length).toEqual(5)
    expect(imported.rows[0]).toEqual(expectedRowsHeaderNoShipmentItem)
    expect(imported.rows[1]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
       null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']

    )
    expect(imported.rows[2]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55,null,null,null,null,
       null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[3]).toEqual(
    ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8,null,null,null,null,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROD_ITEM','99011',null,null,1,8,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[4]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'USPS',2.99,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
})

it('add multiple shipment rows when option set to shipment and multiple shipments with SHIPMENT_PACKED statuses', function() {

  var payment = basicPayment, imported

  results.configuration = {
    facilityUrlDefault:'/fac/1001',
    partyUrlDefault:'/pg/10001',
    invoice:'##createinvoice',
    productPromoUrlProcessing:'##unspecified',
    expandBillOfMaterialsPolicy:'##noexpand',
    sourceDefault:{invoice: "##createinvoice", shipment: "##shipment", facilityUrlLocation: "/fac/900"} 
  }

   results.order = {orderUrl:'/dev/api/order/2879'.w(),orderId:'1203151258'.w(),shipmentUrlList:['/s/200 /s/201 /s/202'.w()],userFieldDataList:[
        [{attrName:'integration_etsysku_10001',attrValue:'HASH_ABCD 1203151258 1500586325'}]],}

   results.shipment = {shipmentUrl:'/s/200 /s/201 /s/202'.w(),shipmentIdUser:'200 201 202'.w(),statusId:'SHIPMENT_CANCELLED SHIPMENT_PACKED SHIPMENT_PACKED'.w()}

    imported = m.importConfiguration().importEntity(results, payment)
    expect(imported.syncStatus).toEqual('##ready')
    expect(imported.entity).toEqual(payment)
    expect(imported.entityId).toEqual('1203151258')
    expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_AD5C 1203151258 1500586325'})
    expect(imported.scanLookups).toEqual([
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
        {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
    ])
    expect(imported.warnings).toEqual([])
    expect(imported.rows.length).toEqual(7)
    expect(imported.rows[0]).toEqual(expectedRowsHeaderNoShipmentItem)
    expect(imported.rows[1]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
       null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']

    )
    expect(imported.rows[2]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55,null,null,null,null,
       null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[3]).toEqual(
    ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8,null,null,null,null,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROD_ITEM','99011',null,null,1,8,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[4]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'USPS',2.99,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[5]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,null,null,null,null,'SALES_SHIPMENT','201','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[6]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,null,null,null,null,'SALES_SHIPMENT','202','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
})

it('no shipment informations mapped when importing a pending order', function() {

 var payment = makePayment(basicPayment, {"was_paid":false}),imported

    results.configuration = {
      facilityUrlDefault:'/fac/1001',
      partyUrlDefault:'/pg/10001',
      invoice:'##createinvoice',
      productPromoUrlProcessing:'##unspecified',
      expandBillOfMaterialsPolicy:'##noexpand',
      sourceDefault:{invoice: "##createinvoice", shipment: "##shipment", facilityUrlLocation: "/fac/900"}
    }

    imported = m.importConfiguration().importEntity(results, payment)
    expect(imported.syncStatus).toEqual('##ready')
    expect(imported.entity).toEqual(payment)
    expect(imported.entityId).toEqual('1203151258')
    expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_4D9F 1203151258 1500586325'})
    expect(imported.scanLookups).toEqual([
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
        {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
    ])
    expect(imported.warnings).toEqual([])
    expect(imported.rows.length).toEqual(5)
    expect(imported.rows[0]).toEqual(expectedRowsHeaderNoShipmentItem)
    expect(imported.rows[1]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
       null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[2]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
       null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[3]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[4]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'USPS',2.99,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    
})

it('does not create shipment when configured to no shipment', function() {

  var payment = basicPayment, imported

    results.configuration = {
      facilityUrlDefault:'/fac/1001',
      partyUrlDefault:'/pg/10001',
      invoice:'##createinvoice',
      productPromoUrlProcessing:'##unspecified',
      expandBillOfMaterialsPolicy:'##noexpand',
      sourceDefault:{invoice: "##createinvoice", shipment: "##noshipment", facilityUrl: "/fac/1001", facilityUrlLocation: "/fac/900"}
    }

    
    imported = m.importConfiguration().importEntity(results, payment)
    expect(imported.syncStatus).toEqual('##ready')
    expect(imported.entity).toEqual(payment)
    expect(imported.entityId).toEqual('1203151258')
    expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_F1FA 1203151258 1500586325'})
    expect(imported.scanLookups).toEqual([
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
        {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
    ])
    expect(imported.warnings).toEqual([])
    expect(imported.rows.length).toEqual(5)
    expect(imported.rows[0]).toEqual(expectedRowsHeader)
    expect(imported.rows[1]).toEqual(
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
         null,null,null,null,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[2]).toEqual(
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55,null,null,null,null,
         null,null,null,null,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[3]).toEqual(
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8,null,null,null,null,null,null,null,null,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROD_ITEM','99011',null,null,1,8,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[4]).toEqual(
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'USPS',2.99,
         null,null,null,null,null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
})

 it('creates a shipment when configured to magazine and facilityUrlDefault configured to unspecified for old UI', function() {

  var payment = basicPayment, imported

    results.configuration = {
      facilityUrlDefault:'##unspecified',
      partyUrlDefault:'/pg/10001',
      invoice:'##createinvoice',
      productPromoUrlProcessing:'##unspecified',
      expandBillOfMaterialsPolicy:'##noexpand',
      sourceDefault:{invoice: "##createinvoice", shipment: "##magazine", facilityUrl: "/fac/1001", facilityUrlLocation: "/fac/900"}
    }

    
    imported = m.importConfiguration().importEntity(results, payment)
    expect(imported.syncStatus).toEqual('##ready')
    expect(imported.entity).toEqual(payment)
    expect(imported.entityId).toEqual('1203151258')
    expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_A7D9 1203151258 1500586325'})
    expect(imported.scanLookups).toEqual([
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
        {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
    ])
    expect(imported.warnings).toEqual([])
    expect(imported.rows.length).toEqual(5)
    expect(imported.rows[0]).toEqual(expectedRowsHeader)
    expect(imported.rows[1]).toEqual(
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[2]).toEqual(
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[3]).toEqual(
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',3,'99011',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROD_ITEM','99011',null,null,1,8,null,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[4]).toEqual(
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'USPS',2.99,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,
        'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
})

it('no packed shipments warning when importing a completed order and configured to use shipments packed in Finale', function() {

    var payment = basicPayment, imported

    results.configuration = {
      facilityUrlDefault:'/fac/1001',
      partyUrlDefault:'/pg/10001',
      invoice:'##createinvoice',
      productPromoUrlProcessing:'##unspecified',
      expandBillOfMaterialsPolicy:'##noexpand',
      sourceDefault:{invoice: "##createinvoice", shipment: "##shipment", facilityUrlLocation: "/fac/900"}
    }

    imported = m.importConfiguration().importEntity(results, payment)
    expect(imported.syncStatus).toEqual('##ready')
    expect(imported.entity).toEqual(payment)
    expect(imported.entityId).toEqual('1203151258')
    expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_4D9F 1203151258 1500586325'})
    expect(imported.scanLookups).toEqual([
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
        {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
    ])
    expect(imported.warnings).toEqual([{msg:'No packed shipments'}])
    expect(imported.rows.length).toEqual(5)
    expect(imported.rows[0]).toEqual(expectedRowsHeaderNoShipmentItem)
    expect(imported.rows[1]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
       null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[2]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
       null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[3]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )
    expect(imported.rows[4]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'USPS',2.99,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
    )  
})    

it('map orderCustomer to existing customer in finale', function() {
      var payment = makePayment(basicPayment, {"name": "Alpha Fireworks"})

    results.configuration.expandBillOfMaterialsPolicy = '##noexpand'
    expect(m.importConfiguration().importEntity(results, _.cloneDeep(payment))).toEqual({
      syncStatus:'##ready',
      entity:payment,
      entityId:'1203151258',
      userField:{attrName:'integration_etsysku_10001',attrValue:'HASH_00DC 1203151258 1500586325'},
      warnings:[],
      scanLookups:[
        {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
        {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
        {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
      ],
      rows:[expectedRowsHeader,
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Alpha Fireworks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
        'Alpha Fireworks','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Alpha Fireworks','Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
        'Alpha Fireworks','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Alpha Fireworks','Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8.00,null,null,null,null,
         'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',3,'99011',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROD_ITEM','99011',null,null,1,8,null,
         'Alpha Fireworks','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
        ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Alpha Fireworks','Etsy Sku',null,null,null,null,null,
            4,null,'USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
            '1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,
        'Alpha Fireworks','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'],
      ],
    })
  })

  it('map orderCustomer to null when partyUrlDefault is unspecified', function() {

      var payment = makePayment(basicPayment, {}), imported

      results.configuration.expandBillOfMaterialsPolicy = '##noexpand'
      results.configuration.partyUrlDefault = '##unspecified'

      imported = m.importConfiguration().importEntity(results, payment)
      expect(imported.syncStatus).toEqual('##ready')
      expect(imported.entity).toEqual(payment)
      expect(imported.entityId).toEqual('1203151258')
      expect(imported.userField).toEqual({attrName:'integration_etsysku_10001',attrValue:'HASH_2DE6 1203151258 1500586325'})
      expect(imported.scanLookups).toEqual([
          {"scanLookupScanKey":"99012","scanLookupNotes":"Boss Lady Pen Set","scanLookupProductId":"99012"},
          {"scanLookupScanKey":"99010","scanLookupNotes":"Modern Marble Wedding Guest Book","scanLookupProductId":"99010"},
          {"scanLookupScanKey":"99011","scanLookupNotes":"Imperfect / Sample Mint Boss Lady Coffee Mug","scanLookupProductId":"99011"}
      ])
      expect(imported.warnings).toEqual([])
      expect(imported.rows.length).toEqual(5)
      expect(imported.rows[0]).toEqual(expectedRowsHeader)
      expect(imported.rows[1]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900',null,'Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,
      'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
      )
      expect(imported.rows[2]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900',null,'Etsy Sku',2,'99010','99010 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,
      'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
      )
      expect(imported.rows[3]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900',null,'Etsy Sku',3,'99011','99011 Imperfect / Sample Mint Boss Lady Coffee Mug',1,8.00,null,null,null,null,
      'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',3,'99011',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROD_ITEM','99011',null,null,1,8,null,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
      )
      expect(imported.rows[4]).toEqual(
      ['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900',null,'Etsy Sku',null,null,null,null,null,
      4,null,'USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,
      '1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,
      'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com']
      )
    })

  describe('parseItemsForOrder', function() {

    it('single item', function() {
      var parsedItems = m.parseItemsForOrder(results, [
        {
          "transaction_id": 1283842164,
          "title":"Boss Lady Pen Set",
          "seller_user_id": 29897567,"buyer_user_id": 30001473,"price":"15.00","currency_code": "USD","quantity": 1,
          "receipt_id": 1203151258,"shipping_cost": "0.00","is_digital": false,"listing_id": 399585557,
          "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
          "variations": [],
          "product_data": {"product_id": 38571872,"sku": "99012",
              "offerings": [{"offering_id": 39261095,
                      "price": {"amount": 1500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD",
                          "currency_formatted_raw": "15.00"},
                      "quantity": 121,"is_enabled": 1,"is_deleted": 0}
                  ],
                  "is_deleted": 0
              }
        }
      ])
      expect(parsedItems.length).toBe(1)
      expect(parsedItems[0]).toEqual({ finale : { productIdOrScanKey:'99012', quantity:1, unitPrice:15 }, name:'Boss Lady Pen Set', original:{ buyer_feedback_id:null, buyer_user_id:30001473, currency_code:'USD', is_digital:false, is_quick_sale:false, listing_id:399585557, price:'15.00', product_data:{ is_deleted:0, offerings:[{is_deleted:0, is_enabled:1, offering_id:39261095, price:{amount:1500, currency_code:'USD',currency_formatted_long:'$15.00 USD', currency_formatted_raw:'15.00', currency_formatted_short:'$15.00', divisor:100 }, quantity:121}], product_id:38571872, sku:'99012' }, quantity:1, receipt_id:1203151258, seller_feedback_id:null, seller_user_id:29897567, shipping_cost:'0.00', title:'Boss Lady Pen Set', transaction_id:1283842164, transaction_type:'listing', variations:[]}, sku:'99012'})
    })

    it('multiple order items', function() {
      var parsedItems = m.parseItemsForOrder(results, [
        {
          "transaction_id": 1283842164,
          "title":"Boss Lady Pen Set",
          "seller_user_id": 29897567,"buyer_user_id": 30001473,"price":"15.00","currency_code": "USD","quantity": 1,
          "receipt_id": 1203151258,"shipping_cost": "0.00","is_digital": false,"listing_id": 399585557,
          "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
          "variations": [],
          "product_data": {"product_id": 38571872,"sku": "99012",
              "offerings": [{"offering_id": 39261095,
                      "price": {"amount": 1500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD",
                          "currency_formatted_raw": "15.00"},
                      "quantity": 121,"is_enabled": 1,"is_deleted": 0}
                  ],
                  "is_deleted": 0
              }
        },
        {
          "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book",
          "seller_user_id": 29897567,"buyer_user_id": 110067200,"price": "55.00","currency_code": "USD","quantity": 1,"image_listing_id": 1202700319,
          "receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"listing_id": 502938896,
          "is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing",
          "variations": [],
          "product_data": {"product_id": 1069080711,"sku": "99010",
              "offerings": [{"offering_id": 1250026666,
                      "price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD",
                          "currency_formatted_raw": "55.00"},
                      "quantity": 474,"is_enabled": 1,"is_deleted": 0}
              ],
              "is_deleted": 0
          }
        }
      ])
      expect(parsedItems.length).toBe(2)
      expect(parsedItems[0]).toEqual({ finale : { productIdOrScanKey:'99012', quantity:1, unitPrice:15 }, name:'Boss Lady Pen Set', original : { buyer_feedback_id:null, buyer_user_id:30001473,currency_code:'USD', is_digital:false, is_quick_sale :false, listing_id:399585557, price:'15.00', product_data:{ is_deleted:0, offerings:[ { is_deleted:0, is_enabled:1, offering_id:39261095, price:{ amount:1500, currency_code:'USD', currency_formatted_long:'$15.00 USD',currency_formatted_raw:'15.00', currency_formatted_short:'$15.00', divisor:100 }, quantity:121 } ], product_id:38571872, sku:'99012' }, quantity:1, receipt_id:1203151258, seller_feedback_id:null, seller_user_id:29897567, shipping_cost:'0.00', title:'Boss Lady Pen Set', transaction_id:1283842164, transaction_type:'listing', variations: [  ] }, sku:'99012' })
      expect(parsedItems[1]).toEqual({ finale : { productIdOrScanKey:'99010', quantity:1, unitPrice:55 }, name:'Modern Marble Wedding Guest Book', original: { buyer_feedback_id:null, buyer_user_id:110067200, currency_code:'USD', image_listing_id:1202700319, is_digital:false, is_quick_sale:false, listing_id:502938896, price:'55.00', product_data : { is_deleted:0, offerings: [ { is_deleted:0, is_enabled:1, offering_id:1250026666, price:{ amount:5500, currency_code:'USD', currency_formatted_long:'$55.00 USD',currency_formatted_raw:'55.00', currency_formatted_short:'$55.00', divisor:100 }, quantity:474 } ], product_id:1069080711, sku:'99010'}, quantity:1, receipt_id:1201564610, seller_feedback_id:null, seller_user_id:29897567, shipping_cost:'0.00', title :'Modern Marble Wedding Guest Book', transaction_id:1293312015, transaction_type:'listing', variations :[]},sku:'99010'})
    })

  })

  describe('wildcard support', function() {

    beforeEach(function() {
      results.configuration.wildcardList = [
        {pattern:'99?10', action:'##nowildimport'},
        {pattern:'98*', action:'##wildimport', lookup:'99010'},
        {pattern:'97*', action:'##wildpreset', productPromoUrl:'/ppu/129'}]
    })

    it('do not import matching sku', function() {
        var fakeOrder = fakeEtsyOrder({transactions:[
        {
          "transaction_id": 1283842164,"title":"Boss Lady Pen Set","seller_user_id": 29897567,"buyer_user_id": 30001473,"price":"15.00","currency_code": "USD","quantity":1,"receipt_id": 1203151258,"shipping_cost": "0.00","listing_id": 399585557,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type":"listing","variations": [],"product_data": {"product_id": 38571872,"sku":"99012","property_values": [],
              "offerings": [{"offering_id": 39261095,"price": {"amount": 1500,"divisor": 100,"currency_code":"USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD","currency_formatted_raw": "15.00"},"quantity": 121,"is_enabled": 1,"is_deleted": 0}
                  ],"is_deleted": 0
              }
          },
          {
              "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book","seller_user_id": 29897567,"buyer_user_id": 110067200,"price": "55.00","currency_code": "USD","quantity": 1,"receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"listing_id": 502938896,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing","variations": [],
                      "product_data": {"product_id":1069080711,"sku":"99010","property_values": [],"offerings": [{"offering_id": 1250026666,"price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD","currency_formatted_raw": "55.00"},"quantity": 474,"is_enabled": 1,"is_deleted": 0}
                      ],"is_deleted": 0
                  }
          }
          ]}),

          rslt = pivotTable.importEntityList(results, m.importConfiguration(), [fakeOrder])

          expect(rslt.length, 1)
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].scanLookups).toEqual([{scanLookupScanKey:'99012', scanLookupNotes:'Boss Lady Pen Set', scanLookupProductId: '99012'}])
          expect(rslt[0].rows.length).toBe(6)
          expect(rslt[0].rows[0]).toEqual(expectedRowsHeader)
          expect(rslt[0].rows[1]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[2]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,2,null,'Discount',-5,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROMOTION_ADJ',null,'Discount',null,null,null,-5,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[3]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,3,null,'USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[4]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'Tax',2,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'Tax',null,null,null,2,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[5]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,5,null,'VAT',1.8,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',5,'INV_PROMOTION_ADJ',null,'VAT',null,null,null,1.8,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
    })

    it('import using specified product lookup for matching sku', function() {
        var fakeOrder = fakeEtsyOrder({transactions:[
        {
          "transaction_id": 1283842164,"title":"Boss Lady Pen Set","seller_user_id": 29897567,"buyer_user_id": 30001473,"price":"15.00","currency_code": "USD","quantity":1,"receipt_id": 1203151258,"shipping_cost": "0.00","listing_id": 399585557,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type":"listing","variations": [],"product_data": {"product_id": 38571872,"sku":"99012","property_values": [],
              "offerings": [{"offering_id": 39261095,"price": {"amount": 1500,"divisor": 100,"currency_code":"USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD","currency_formatted_raw": "15.00"},"quantity": 121,"is_enabled": 1,"is_deleted": 0}
                  ],"is_deleted": 0
              }
          },
          {
              "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book","seller_user_id": 29897567,"buyer_user_id": 110067200,"price": "55.00","currency_code": "USD","quantity": 1,"receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"listing_id": 502938896,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing","variations": [],
                      "product_data": {"product_id":1069080711,"sku":"98123","property_values": [],"offerings": [{"offering_id": 1250026666,"price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD","currency_formatted_raw": "55.00"},"quantity": 474,"is_enabled": 1,"is_deleted": 0}
                      ],"is_deleted": 0
                  }
          }
          ]}),

          rslt = pivotTable.importEntityList(results, m.importConfiguration(), [fakeOrder])

          expect(rslt.length, 1)
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].scanLookups).toEqual([{ scanLookupNotes : 'Boss Lady Pen Set', scanLookupProductId : '99012', scanLookupScanKey : '99012' }, { scanLookupNotes : 'Modern Marble Wedding Guest Book', scanLookupProductId : '99010', scanLookupScanKey : '99010' }])
          expect(rslt[0].rows.length).toBe(7)
          expect(rslt[0].rows[0]).toEqual(expectedRowsHeader)
          expect(rslt[0].rows[1]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Boss Lady Pen Set',1,15.00,null,null,null,null,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,15,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[2]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99010','98123 Modern Marble Wedding Guest Book',1,55,null,null,null,null,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',2,'99010',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROD_ITEM','99010',null,null,1,55,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[3]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,3,null,'Discount',-5,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROMOTION_ADJ',null,'Discount',null,null,null,-5,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[4]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[5]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,5,null,'Tax',2,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',5,'INV_PROMOTION_ADJ',null,'Tax',null,null,null,2,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[6]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,6,null,'VAT',1.8,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',6,'INV_PROMOTION_ADJ',null,'VAT',null,null,null,1.8,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
    })

    it('import using specified discount & fee preset for matching sku', function() {
        var fakeOrder = fakeEtsyOrder({transactions:[
        {
          "transaction_id": 1283842164,"title":"Boss Lady Pen Set","seller_user_id": 29897567,"buyer_user_id": 30001473,"price":"15.00","currency_code": "USD","quantity":1,"receipt_id": 1203151258,"shipping_cost": "0.00","listing_id": 399585557,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type":"listing","variations": [],"product_data": {"product_id": 38571872,"sku":"97321","property_values": [],
              "offerings": [{"offering_id": 39261095,"price": {"amount": 1500,"divisor": 100,"currency_code":"USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD","currency_formatted_raw": "15.00"},"quantity": 121,"is_enabled": 1,"is_deleted": 0}
                  ],"is_deleted": 0
              }
          },
          {
              "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book","seller_user_id": 29897567,"buyer_user_id": 110067200,"price": "55.00","currency_code": "USD","quantity": 1,"receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"listing_id": 502938896,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing","variations": [],
                      "product_data": {"product_id":1069080711,"sku":"99012","property_values": [],"offerings": [{"offering_id": 1250026666,"price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD","currency_formatted_raw": "55.00"},"quantity": 474,"is_enabled": 1,"is_deleted": 0}
                      ],"is_deleted": 0
                  }
          },
          {
              "transaction_id": 1295333899,"title": "Sample Mint Boss Lady Coffee Mug","seller_user_id": 29897567,"buyer_user_id": 115435195,"price": "8.00","currency_code": "USD","quantity": 2,"receipt_id": 1203112008,"shipping_cost": "0.00",
              "is_digital": false,"listing_id": 250958729,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing","variations": [],"product_data": {
                  "product_id": 40761311,"sku": "97456","property_values": [],"offerings": [{"offering_id": 40572586,"price": {"amount": 800,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$8.00","currency_formatted_long": "$8.00 USD","currency_formatted_raw": "8.00"},"quantity": 104,"is_enabled": 1,"is_deleted": 0}],"is_deleted": 0
              }
          }

          ]}),

          rslt = pivotTable.importEntityList(results, m.importConfiguration(), [fakeOrder])

          expect(rslt.length, 1)
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].scanLookups).toEqual([{ scanLookupNotes:'Modern Marble Wedding Guest Book', scanLookupProductId :'99012', scanLookupScanKey:'99012' }])
          expect(rslt[0].rows.length).toBe(8)
          expect(rslt[0].rows[0]).toEqual(expectedRowsHeader)
          expect(rslt[0].rows[1]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,'99012','99012 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',1,'99012',1,'/fac/1001','1203151258-1','2017-06-12T05:58:50Z','Posted',1,'INV_PROD_ITEM','99012',null,null,1,55,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[2]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,2,'Promotion 1','Boss Lady Pen Set',15,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',2,'INV_PROMOTION_ADJ',null,'Boss Lady Pen Set','Promotion 1',null,null,15,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[3]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,3,'Promotion 1','2 x Sample Mint Boss Lady Coffee Mug',16,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',3,'INV_PROMOTION_ADJ',null,'2 x Sample Mint Boss Lady Coffee Mug','Promotion 1',null,null,16,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[4]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'Discount',-5,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',4,'INV_PROMOTION_ADJ',null,'Discount',null,null,null,-5,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[5]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,5,null,'USPS',2.99,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',5,'INV_PROMOTION_ADJ',null,'USPS',null,null,null,2.99,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[6]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,6,null,'Tax',2,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',6,'INV_PROMOTION_ADJ',null,'Tax',null,null,null,2,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[7]).toEqual(['SALES_ORDER','1203151258','ORDER_COMPLETED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,7,null,'VAT',1.8,'SALES_SHIPMENT','1203151258-1','SHIPMENT_SHIPPED','2017-06-12T05:58:50Z',null,null,null,null,'1203151258-1','2017-06-12T05:58:50Z','Posted',7,'INV_PROMOTION_ADJ',null,'VAT',null,null,null,1.8,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
    })

    it('import using specified product lookup for matching sku and create scanlookup', function() {
        var fakeOrder = fakeEtsyOrder({transactions:[
        {
          "transaction_id": 1283842164,"title":"Boss Lady Pen Set","seller_user_id": 29897567,"buyer_user_id": 30001473,"price":"15.00","currency_code": "USD","quantity":1,"receipt_id": 1203151258,"shipping_cost": "0.00","listing_id": 399585557,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type":"listing","variations": [],"product_data": {"product_id": 38571872,"sku":"98123","property_values": [],
              "offerings": [{"offering_id": 39261095,"price": {"amount": 1500,"divisor": 100,"currency_code":"USD","currency_formatted_short": "$15.00","currency_formatted_long": "$15.00 USD","currency_formatted_raw": "15.00"},"quantity": 121,"is_enabled": 1,"is_deleted": 0}
                  ],"is_deleted": 0
              }
          },
          {
              "transaction_id": 1293312015,"title":"Modern Marble Wedding Guest Book","seller_user_id": 29897567,"buyer_user_id": 110067200,"price": "55.00","currency_code": "USD","quantity": 1,"receipt_id": 1201564610,"shipping_cost": "0.00","is_digital": false,"listing_id": 502938896,"is_quick_sale": false,"seller_feedback_id": null,"buyer_feedback_id": null,"transaction_type": "listing","variations": [],
                      "product_data": {"product_id":1069080711,"sku":"99012","property_values": [],"offerings": [{"offering_id": 1250026666,"price": {"amount": 5500,"divisor": 100,"currency_code": "USD","currency_formatted_short": "$55.00","currency_formatted_long": "$55.00 USD","currency_formatted_raw": "55.00"},"quantity": 474,"is_enabled": 1,"is_deleted": 0}
                      ],"is_deleted": 0
                  }
          }
          ]}),rslt

          results.configuration.wildcardList[1].lookup = '99019',

          rslt = pivotTable.importEntityList(results, m.importConfiguration(), [fakeOrder])

          expect(rslt.length, 1)
          expect(rslt[0].warnings).toEqual([{ msg : 'No product lookup for', scanLookupNotes : "Boss Lady Pen Set", scanLookupProductId : '', scanLookupScanKey : '99019' }])
          expect(rslt[0].scanLookups).toEqual([{ scanLookupNotes:'Boss Lady Pen Set', scanLookupProductId:'', scanLookupScanKey:'99019' }, { scanLookupNotes:'Modern Marble Wedding Guest Book',scanLookupProductId:'99012', scanLookupScanKey:'99012' }])
          expect(rslt[0].rows.length).toBe(7)
          expect(rslt[0].rows[0]).toEqual(expectedRowsHeader)
          expect(rslt[0].rows[1]).toEqual(['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',1,null,'98123 Boss Lady Pen Set',1,15.00,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[2]).toEqual(['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',2,'99012','99012 Modern Marble Wedding Guest Book',1,55.00,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[3]).toEqual(['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,3,null,'Discount',-5,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[4]).toEqual(['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,4,null,'USPS',2.99,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[5]).toEqual(['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,5,null,'Tax',2,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
          expect(rslt[0].rows[6]).toEqual(['SALES_ORDER','1203151258','ORDER_LOCKED','2017-06-11T22:28:27Z','/fac/900','Big Parks','Etsy Sku',null,null,null,null,null,6,null,'VAT',1.8,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,'Robin Ferragamo','Robin\n47 Claradon Lane','Staten Island','NY','10305','USA','vvinrobali@aol.com'])
    })

  })

  describe('syncProducts', function() {
      var fakeProductEntity, fakeVariationProductEntity

      beforeEach(function() {
        results = _.assign(results, {connection:{connectionUrl:['/conn/10001'],connectionId:['10001'],integrationOptions:[{productStoreUrl:'/psu/149'}]}})

        fakeProductEntity = {
          listing_id:923, title:"Backpack", description:"Finale test product", price:11, sku:["ABCDE"],has_variations:false,
          finale_image:[{listing_image_id: 111,listing_id: 923,url_fullxfull: "https://example.com/image-1.jpg"}]
        }

        fakeVariationProductEntity = {
          listing_id:923, title:"Backpack", description:"Finale test product", price:11, sku:["ABCDE","ABCDE-1","ABCDE-2"],has_variations:true,
          finale_variants:[{product_id:924 ,sku:"ABCDE", property_values:[{property_id: 513,property_name: "Printed Design",value_ids: [2887783171],values: ["5x7"]},{property_id: 514,property_name: "Size",value_ids: [2887783172],values: ["M"]}],offerings: [{offering_id: 35666660,price: {currency_formatted_raw: 8.00}}]},
                             {product_id: 925,sku: "ABCDE-1",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [20186167261],values: ["2-5x7"]}],offerings: [{offering_id: 35666662,price: {currency_formatted_raw: 16.00}}]},
                             {product_id: 926,sku: "ABCDE-2",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [2962381386],values: ["8x10"]}],offerings: [{offering_id: 35666664,price: {currency_formatted_raw: 12.00}}]}], 
          finale_image:[{listing_image_id: 111,listing_id: 923,url_fullxfull: "https://example.com/image-1.jpg"},
                          {listing_image_id: 222,listing_id: 923,url_fullxfull: "https://example.com/image-2.jpg"},
                          {listing_image_id: 333,listing_id: 923,url_fullxfull: "https://example.com/image-3.jpg"}]
        }
      })

      it('externalProductIdPrefix', function() {
        expect(m.externalProductIdPrefix()).toBe('etsysku_product_10001_')
      })

      it('externalProductIdForEntity', function() {
        expect(m.externalProductIdForEntity(fakeProductEntity)).toBe('etsysku_product_10001_923')
      })

      it('insertUpdateForProduct', function() {
        expect(m.insertUpdateForProduct(fakeProductEntity))
          .toEqual({externalId:'etsysku_product_10001_923', description:'ABCDE', metaData:'X', objectData:{product:fakeProductEntity}})
      })

      it('productIdForExternalId', function() {
        expect(m.productIdForExternalId('etsysku_product_10001_12879')).toBe('12879')
      })

      it('externalProductIdForUserFieldAttrValue', function() {
        expect(m.externalProductIdForUserFieldAttrValue('HASH_5442 12879 1500586325')).toBe('etsysku_product_10001_12879')
      })

      it('productIdListForProductList', function() {
        expect(m.productIdListForProductList({}, [fakeProductEntity])).toEqual(['ABCDE'])
        expect(m.productIdListForProductList({}, [{sku:['ABCDE']},{sku:['ABCDG']},{sku:['ABCDF']}])).toEqual(['ABCDE', 'ABCDF', 'ABCDG'])
        expect(m.productIdListForProductList({}, [fakeVariationProductEntity])).toEqual(['ABCDE','ABCDE-1','ABCDE-2'])
      })

      describe('finaleProductIdForEtsyskuProduct', function() {
        it('uses sku when no existing product', function() {
          expect(m.finaleProductIdForEtsyskuProduct({}, null, {sku:['87124'], title:'Backpack'})).toBe('87124')
        })

        it('does not use productId for existing order without etsysku userField', function() {
          var results = {product:{productId:['999-123'], userFieldDataList:null}},
              product = {sku:['999-123'], id:87124}
          expect(m.finaleProductIdForEtsyskuProduct(results, null, product)).toBe('999-123A')
          results.product.userFieldDataList = [[]]
          expect(m.finaleProductIdForEtsyskuProduct(results, null, product)).toBe('999-123A')
          results.product.productId = ['999-123', '999-123A', '999-123B']
          expect(m.finaleProductIdForEtsyskuProduct(results, null, product)).toBe('999-123C')
        })

        it('does use productId for existing product with userField containing matching etsysku product id', function() {
          var results = {product:{productId:['999-123'], userFieldDataList:[
                [{attrName:'integration_etsysku_10001', attrValue:'HASH_34CA 87124'}]]}},
              product = {sku:['999-123'], id:87124}
          expect(m.finaleProductIdForEtsyskuProduct(results, null, product)).toBe('999-123A')
        })

        it('does not use productId for existing product with userField containing a different etsysku product id', function() {
          var results = {product:{productId:['999-123'], userFieldDataList:[
                [{attrName:'integration_etsysku_10001', attrValue:'HASH_34CA 98235'}]]}},
              product = {sku:['999-123'], id:87124}
          expect(m.finaleProductIdForEtsyskuProduct(results, null, product)).toBe('999-123A')
        })
      })

      it('product dimensions', function() {
        expect(_.map(m.productDimensions, 'dimensionKey')).toEqual(['productProductId', 'productDescription', 'productNotes',
          'productItemPrice', 'productProductImageUrl', 'scanLookupScanKey', 'scanLookupNotes', 'scanLookupStoresToAdd'])
      })

    describe('productListFilter', function() {
      var log

      beforeEach(function() {
        log = {infoUser:jasmine.createSpy()}
      })

      it('includes product with sku', function() {
        expect(m.productListFilter(log, {}, fakeProductEntity)).toBe(true)
        expect(log.infoUser.argsForCall.length).toBe(0)
      })

      it('excludes product without sku', function() {
        delete fakeProductEntity.sku
        expect(m.productListFilter(log, {}, fakeProductEntity)).toBe(false)
        expect(log.infoUser.argsForCall.length).toBe(1)
        expect(log.infoUser.argsForCall[0]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack'], {externalId:'923', name:'Backpack'}])
      })

      it('includes product that has a variation with sku', function() {
        var i = 0

        expect(m.productListFilter(log, {}, fakeVariationProductEntity)).toBe(true)
        expect(log.infoUser.argsForCall.length).toBe(0)

        _.forEach(fakeVariationProductEntity.finale_variants, function(cur) {
          delete cur.sku
        })
        
        expect(m.productListFilter(log, {}, fakeVariationProductEntity)).toBe(true)
        expect(log.infoUser.argsForCall.length).toBe(3)
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack - 5x7, M', true],
          {externalId:'923,924', name:'Backpack - 5x7, M'}])
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack - 2-5x7', true],
          {externalId:'923,925', name:'Backpack - 2-5x7'}])
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack - 8x10', true],
          {externalId:'923,926', name:'Backpack - 8x10'}])

        delete fakeVariationProductEntity.sku
        fakeVariationProductEntity.finale_variants[2].sku = 'ABCDE-3'
        expect(m.productListFilter(log, {}, fakeVariationProductEntity)).toBe(true)
        expect(log.infoUser.argsForCall.length).toBe(i + 3)
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack'],
          {externalId:'923', name:'Backpack'}])
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack - 5x7, M', true],
          {externalId:'923,924', name:'Backpack - 5x7, M'}])
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack - 2-5x7', true],
          {externalId:'923,925', name:'Backpack - 2-5x7'}])

      })

      it('exludes product that has no variation skus', function() {
        var i = 0

        delete fakeVariationProductEntity.sku
        _.forEach(fakeVariationProductEntity.finale_variants, function(cur) {
          delete cur.sku
        })
        expect(m.productListFilter(log, {}, fakeVariationProductEntity)).toBe(false)
        expect(log.infoUser.argsForCall.length).toBe(4)
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack'],
          {externalId:'923', name:'Backpack'}])
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack - 5x7, M', true],
          {externalId:'923,924', name:'Backpack - 5x7, M'}])
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack - 2-5x7', true],
          {externalId:'923,925', name:'Backpack - 2-5x7'}])
        expect(log.infoUser.argsForCall[i++]).toEqual(['##connectionTaskSyncProductNoSku', ['Backpack - 8x10', true],
          {externalId:'923,926', name:'Backpack - 8x10'}])
      })
      
    })

    it('expandProductForVariations', function() {
      var expandedProduct = m.expandProductForVariations(fakeVariationProductEntity)

      expect(m.expandProductForVariations(fakeProductEntity)).toEqual([fakeProductEntity])

      expect(expandedProduct[0]).toEqual({
        product_id:924 ,sku:"ABCDE", property_values:[{property_id: 513,property_name: "Printed Design",value_ids: [2887783171],values: ["5x7"]},{property_id: 514,property_name: "Size",value_ids: [2887783172],values: ["M"]}],offerings: [{offering_id: 35666660,price: {currency_formatted_raw: 8.00}}],
        finale_variation : 923, finale_name : 'Backpack - 5x7, M', finale_notes : 'Finale test product', finale_price:11, finale_image:"https://example.com/image-1.jpg"})
      expect(expandedProduct[1]).toEqual({
        product_id: 925,sku: "ABCDE-1",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [20186167261],values: ["2-5x7"]}],offerings: [{offering_id: 35666662,price: {currency_formatted_raw: 16.00}}],
        finale_variation : 923, finale_name : 'Backpack - 2-5x7', finale_notes : 'Finale test product', finale_price:11, finale_image:"https://example.com/image-1.jpg"})
      expect(expandedProduct[2]).toEqual({
        product_id: 926,sku: "ABCDE-2",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [2962381386],values: ["8x10"]}],offerings: [{offering_id: 35666664,price: {currency_formatted_raw: 12.00}}],
       finale_variation : 923, finale_name:'Backpack - 8x10', finale_notes:'Finale test product', finale_price:11, finale_image:'https://example.com/image-1.jpg'})
    })

      describe('importProductEntityList', function() {
        var expectedProductColumnHeaders = ['productProductId', 'productDescription', 'productNotes', 'productItemPrice', 'productProductImageUrl',
              'scanLookupScanKey', 'scanLookupNotes', 'scanLookupStoresToAdd']

        it('works', function() {
          var rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})
        })

        it('uses product id even if already in use', function() {
          var rslt

          results = _.assign(results, {product:{productId:['ABCDE']}})
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})
        })

        it('create scanLookup if it does not exist', function() {
          var rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})
        })

        it('create scanLookup without productStoreUrl if it does not exist', function() {
          var rslt

          results = _.assign(results, {connection:{}})
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', null])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_E989 923 1500586325'})
        })

        it('update scanLookup if it already exists unmapped', function() {
          var rslt

          results = _.assign(results, {scanlookup:{scanKey:['ABCDE'], scanLookupUrl:['/scanlookup/ABCDE']}})
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})
        })

        it('update scanLookup if it already exists for the product', function() {
          var rslt

          results = _.assign(results, {
          product:{productId:['ABCDE'], productUrl:['/p/ABCDE']},
          scanlookup:{scanKey:['ABCDE'], scanLookupUrl:['/scanlookup/ABCDE'], productUrl:['/p/ABCDE']}})
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})
        })

        it('update scanLookup if it already exists for a different product', function() {
          var rslt

          results = _.assign(results, {scanlookup:{scanKey:['ABCDE'], scanLookupUrl:['/scanlookup/ABCDE'], productUrl:['/p/EDCBA']}})
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})
        })

        it('works for variation products', function() {
          var rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity]),
              i = 0

          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack - 5x7, M', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_2233 923,924 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, 'https://example.com/image-1.jpg', 'ABCDE-1', 'Backpack - 2-5x7', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_CD75 923,925 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 12, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 12, 'https://example.com/image-1.jpg', 'ABCDE-2', 'Backpack - 8x10', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_71E3 923,926 1500586325'})
          expect(rslt.length, i)
        })

        it('works for variation products but excludes them if any do not have their own sku', function() {
          var rslt, i
          fakeVariationProductEntity.sku[2] = ''
          delete fakeVariationProductEntity.finale_variants[2].sku
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity]),

          i = 0

          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack - 5x7, M', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_2233 923,924 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, 'https://example.com/image-1.jpg', 'ABCDE-1', 'Backpack - 2-5x7', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_CD75 923,925 1500586325'})
          expect(rslt.length, i)
        })

        it('works for variation with multiple property_values within single property', function() {
          var rslt, i

          fakeVariationProductEntity.finale_variants.push(
                            {product_id:924 ,sku:"ABCDE", property_values:[{property_id: 513,property_name: "Printed Design",value_ids: [2887783171,2887783173],values: ["5x7","4x6"]},{property_id: 514,property_name: "Size",value_ids: [2887783172],values: ["M"]}],offerings: [{offering_id: 35666660,price: {currency_formatted_raw: 8.00}}]},
                            {product_id: 925,sku: "ABCDE-1",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [20186167261],values: ["2-5x7"]}],offerings: [{offering_id: 35666662,price: {currency_formatted_raw: 16.00}}]},
                            {product_id: 926,sku: "ABCDE-2",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [2962381386],values: ["8x10"]}],offerings: [{offering_id: 35666664,price: {currency_formatted_raw: 12.00}}]})
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity]),

          i = 0

          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack - 5x7, 4x6, M', 'Finale test product', 8, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack - 5x7, 4x6, M', 'Finale test product', 8, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack - 5x7, 4x6, M', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_F5A3 923,924 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, 'https://example.com/image-1.jpg', 'ABCDE-1', 'Backpack - 2-5x7', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_CD75 923,925 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 12, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 12, 'https://example.com/image-1.jpg', 'ABCDE-2', 'Backpack - 8x10', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_71E3 923,926 1500586325'})
          expect(rslt.length, i)
        })

        it('works for variation products when finale_image is empty', function() {
          var rslt, i

          fakeVariationProductEntity = {
            listing_id:923, title:"Backpack", description:"Finale test product", price:11, sku:["ABCDE","ABCDE-1","ABCDE-2"],has_variations:true,
            finale_variants:[{product_id:924 ,sku:"ABCDE", property_values:[{property_id: 513,property_name: "Printed Design",value_ids: [2887783171],values: ["5x7"]},{property_id: 514,property_name: "Size",value_ids: [2887783172],values: ["M"]}],offerings: [{offering_id: 35666660,price: {currency_formatted_raw: 8.00}}]},
                               {product_id: 925,sku: "ABCDE-1",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [20186167261],values: ["2-5x7"]}],offerings: [{offering_id: 35666662,price: {currency_formatted_raw: 16.00}}]},
                               {product_id: 926,sku: "ABCDE-2",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [2962381386],values: ["8x10"]}],offerings: [{offering_id: 35666664,price: {currency_formatted_raw: 12.00}}]}], 
            finale_image:[]
          }
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity]),

          i = 0

          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, null, null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, null, 'ABCDE', 'Backpack - 5x7, M', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D7B0 923,924 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, null, null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, null, 'ABCDE-1', 'Backpack - 2-5x7', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_6983 923,925 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 12, null, null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 12, null, 'ABCDE-2', 'Backpack - 8x10', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_292E 923,926 1500586325'})
          expect(rslt.length, i)
        })

        it('works for products when has_variations is false but has single SKUs', function() {
          var rslt, i

          fakeVariationProductEntity = {
            listing_id:923, title:"Backpack", description:"Finale test product", price:11, sku:["ABCDE"],has_variations:false,
            finale_image:[{listing_image_id: 333,listing_id: 923,url_fullxfull: "https://example.com/image-1.jpg"}]
          }
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})
        })

        it('works for products when has_variations is true but has single SKUs', function() {
          var rslt, i

          fakeVariationProductEntity = {
            listing_id:923, title:"Backpack", description:"Finale test product", price:11, sku:["ABCDE"],has_variations:true,
            finale_variants:[{product_id:924 ,sku:"ABCDE", property_values:[{property_id: 513,property_name: "Printed Design",value_ids: [2887783171],values: ["5x7"]},{property_id: 514,property_name: "Size",value_ids: [2887783172],values: ["M"]}],offerings: [{offering_id: 35666660,price: {currency_formatted_raw: 8.00}}]}], 
            finale_image:[{listing_image_id: 333,listing_id: 923,url_fullxfull: "https://example.com/image-1.jpg"}]
          }
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack - 5x7, M', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_2233 923,924 1500586325'})
        })

        it('works for variation products when finale_image is not defined', function() {
          var rslt, i

          fakeVariationProductEntity = {
            listing_id:923, title:"Backpack", description:"Finale test product", price:11, sku:["ABCDE","ABCDE-1","ABCDE-2"],has_variations:true,
            finale_variants:[{product_id:924 ,sku:"ABCDE", property_values:[{property_id: 513,property_name: "Printed Design",value_ids: [2887783171],values: ["5x7"]},{property_id: 514,property_name: "Size",value_ids: [2887783172],values: ["M"]}],offerings: [{offering_id: 35666660,price: {currency_formatted_raw: 8.00}}]},
                               {product_id: 925,sku: "ABCDE-1",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [20186167261],values: ["2-5x7"]}],offerings: [{offering_id: 35666662,price: {currency_formatted_raw: 16.00}}]},
                               {product_id: 926,sku: "ABCDE-2",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [2962381386],values: ["8x10"]}],offerings: [{offering_id: 35666664,price: {currency_formatted_raw: 12.00}}]}]
          }
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity]),

          i = 0

          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, null, null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 8, null, 'ABCDE', 'Backpack - 5x7, M', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D7B0 923,924 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, null, null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 16, null, 'ABCDE-1', 'Backpack - 2-5x7', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_6983 923,925 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 12, null, null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 12, null, 'ABCDE-2', 'Backpack - 8x10', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_292E 923,926 1500586325'})
          expect(rslt.length, i)
        })

        it('price falls back to product price when absent in finale_variation', function() {
          fakeVariationProductEntity = {
            listing_id:923, title:"Backpack", description:"Finale test product", price:11, sku:["ABCDE","ABCDE-1","ABCDE-2"],has_variations:true,
            finale_variants:[{product_id:924 ,sku:"ABCDE", property_values:[{property_id: 513,property_name: "Printed Design",value_ids: [2887783171],values: ["5x7"]},{property_id: 514,property_name: "Size",value_ids: [2887783172],values: ["M"]}],offerings: [{offering_id: 35666660,price: {currency_formatted_raw: 8.00}}]},
                               {product_id: 925,sku: "ABCDE-1",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [20186167261],values: ["2-5x7"]}],offerings: [{offering_id: 35666662,price: {currency_formatted_raw: 16.00}}]},
                               {product_id: 926,sku: "ABCDE-2",property_values: [{property_id: 513,property_name: "Printed Design",value_ids: [2962381386],values: ["8x10"]}],offerings: [{offering_id: 35666664,price: {currency_formatted_raw: 12.00}}]}], 
            finale_image:[{listing_image_id: 111,listing_id: 923,url_fullxfull: "https://example.com/image-1.jpg"},
                            {listing_image_id: 222,listing_id: 923,url_fullxfull: "https://example.com/image-2.jpg"},
                            {listing_image_id: 333,listing_id: 923,url_fullxfull: "https://example.com/image-3.jpg"}]
          }          
          delete fakeVariationProductEntity.finale_variants[0].offerings
          delete fakeVariationProductEntity.finale_variants[1].offerings[0].price
          delete fakeVariationProductEntity.finale_variants[2].offerings[0].price.currency_formatted_raw
          var rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity]),
              i = 0

          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack - 5x7, M', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack - 5x7, M', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_FEDB 923,924 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-1', 'Backpack - 2-5x7', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE-1', 'Backpack - 2-5x7', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_8040 923,925 1500586325'})
          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[i].rows[1]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[i].rows[2]).toEqual(['ABCDE-2', 'Backpack - 8x10', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE-2', 'Backpack - 8x10', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_9601 923,926 1500586325'})
          expect(rslt.length, i)
        })

        it('verify product description gets sliced to 255 characters', function() {
          var rslt, i

          fakeVariationProductEntity = {
            listing_id:923, title:"Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack ", description:"Finale test product", price:11, sku:["ABCDE","ABCDE-1","ABCDE-2"],has_variations:false,
            finale_image:[{listing_image_id: 333,listing_id: 923,url_fullxfull: "https://example.com/image-3.jpg"}]
          }

          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity]),
          i = 0

          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Bac', 'Finale test product', 11, 'https://example.com/image-3.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Bac', 'Finale test product', 11, 'https://example.com/image-3.jpg', 'ABCDE', 'Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Backpack Bac', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_BD19 923 1500586325'})
        })

        it('verify product description with empty title', function() {
          var rslt, i

          fakeVariationProductEntity = {
            listing_id:923, title:"", description:"Finale test product", price:11, sku:["ABCDE","ABCDE-1","ABCDE-2"],has_variations:false,
            finale_image:[{listing_image_id: 333,listing_id: 923,url_fullxfull: "https://example.com/image-3.jpg"}]
          }
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeVariationProductEntity]),

          i = 0

          expect(rslt[i].rows.length).toBe(3)
          expect(rslt[i].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', '', 'Finale test product', 11, 'https://example.com/image-3.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', '', 'Finale test product', 11, 'https://example.com/image-3.jpg', 'ABCDE', 'Unknown', '/psu/149'])
          expect(rslt[i].warnings).toEqual([])
          expect(rslt[i].infos).toEqual([])
          expect(rslt[i].syncStatus).toEqual('##ready')
          expect(rslt[i++].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_9F01 923 1500586325'})
        })

        it('logs when external id changes NEWTSSt', function() {
          var rslt

          results.product = TEST.finaleApiFakeData.product({
            productId:["ABCDE"],
            userFieldDataList:[[{attrName:'integration_etsysku_10001', attrValue:'HASH_ABCD 924 1500586325'}], null, null],
          })

          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([{template:'##connectionTaskSyncProductDifferent', data:['ABCDE'],
            extraInfo:{externalId:'etsysku_product_10001_923', previousExternalId:'etsysku_product_10001_924', productId:'ABCDE'}}])

          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})
        })

        it('blocks duplicate products with same SKU in same import', function() {
          var importConfiguration = m.importConfiguration(),
              rslt = pivotTable.importProductEntityList(results, importConfiguration, [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', null, null, null])
            expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Backpack', 'Finale test product', 11, 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})

          rslt = pivotTable.importProductEntityList(results, importConfiguration, [fakeVariationProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(1)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([{template:'##connectionTaskSyncProductDuplicate', data:['ABCDE'],
            extraInfo:{acceptedExternalId:'etsysku_product_10001_923', externalId:'etsysku_product_10001_923,924', productId:'ABCDE'}}])

          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_78CE 923,924 1500586325'})
        })

        it('blocks updates for inactive products', function() {
          var rslt

          results.product = TEST.finaleApiFakeData.product({
            productId:['ABCDE'],
            statusId:['PRODUCT_INACTIVE'],
          })
          rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(1)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([{template:'##connectionTaskSyncProductInactive', data:['ABCDE'],
            extraInfo:{externalId:'etsysku_product_10001_923', productId:'ABCDE'}}])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_78CE 923 1500586325'})
        })

        it('limit the product description to 255 characters', function() {
          fakeProductEntity.title = 'Wahl Replacement Shaving Head & Cutter Blades with Hypo-Allergenic Silver Foil Head with Bump Prevent Technology, Detaches Easily for Cleaning and Sanitation Replacement Shaving Head with Hypo-Allergenic Gold Foil Head with Bump Prevent Technology, Detaches Easily for Cleaning and Sanitation'
          var rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])

          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Wahl Replacement Shaving Head & Cutter Blades with Hypo-Allergenic Silver Foil Head with Bump Prevent Technology, Detaches Easily for Cleaning and Sanitation Replacement Shaving Head with Hypo-Allergenic Gold Foil Head with Bump Prevent Technology, Detach', 'Finale test product', 11,'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Wahl Replacement Shaving Head & Cutter Blades with Hypo-Allergenic Silver Foil Head with Bump Prevent Technology, Detaches Easily for Cleaning and Sanitation Replacement Shaving Head with Hypo-Allergenic Gold Foil Head with Bump Prevent Technology, Detach', 'Finale test product', 11,'https://example.com/image-1.jpg', 'ABCDE', 'Wahl Replacement Shaving Head & Cutter Blades with Hypo-Allergenic Silver Foil Head with Bump Prevent Technology, Detaches Easily for Cleaning and Sanitation Replacement Shaving Head with Hypo-Allergenic Gold Foil Head with Bump Prevent Technology, Detach', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_B807 923 1500586325'})
        })

        it('do not import title/price when title and price set to ##noimport', function() {
          _.assign(results.configuration, { productFields:[{value:'title',import:"##noimport"},{value:'notes',import:"##import"},{value:'price',import:"##noimport"},{value:'productImage',import:"##import"},{value:'productLookups',import:"##import"}]})
          var rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity]),
          expectedProductColumnHeadersToBeImported = _.filter(expectedProductColumnHeaders, function(cur) { return cur != 'productDescription' && cur != 'productItemPrice'})
          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeadersToBeImported)
          expect(rslt[0].rows[1]).toEqual(['ABCDE', 'Finale test product', 'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual(['ABCDE', 'Finale test product', 'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_E992 923 1500586325'})
        })

        it('do not import title/notes/price for existing product when title , notes and price set to ##importnew', function() {
          results.product = TEST.finaleApiFakeData.product({
          productId:['ABCDE'],
          userFieldDataList:[[{attrName:'integration_etsysku_10001', attrValue:'HASH_E992 923 1500586325'}], null, null],
          })
          _.assign(results.configuration, { productFields:[{value:'title',import:"##importnew"},{value:'notes',import:"##importnew"},{value:'price',import:"##importnew"},{value:'productImage',import:"##import"},{value:'productLookups',import:"##import"}]})
          var rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity]),
          expectedProductColumnHeadersToBeImported = _.filter(expectedProductColumnHeaders, function(cur) { return cur != 'productDescription' && cur != 'productNotes' && cur != 'productItemPrice'})
          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeadersToBeImported)
          expect(rslt[0].rows[1]).toEqual([ 'ABCDE','https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual([ 'ABCDE','https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_5404 923 1500586325'})
        })

        it('do import title/notes/price for new product when title,notes and price set to ##importnew', function() {
          _.assign(results.configuration, { productFields:[{value:'title',import:"##importnew"},{value:'notes',import:"##importnew"},{value:'price',import:"##importnew"},{value:'productImage',import:"##import"},{value:'productLookups',import:"##import"}]})
          var rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])
          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(3)
          expect(rslt[0].rows[0]).toEqual(expectedProductColumnHeaders)
          expect(rslt[0].rows[1]).toEqual([ 'ABCDE','Backpack', 'Finale test product', 11,'https://example.com/image-1.jpg', null, null, null])
          expect(rslt[0].rows[2]).toEqual([ 'ABCDE','Backpack', 'Finale test product', 11,'https://example.com/image-1.jpg', 'ABCDE', 'Backpack', '/psu/149'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_D446 923 1500586325'})
        })

        it('do not import product lookups when productLookup set to ##noimport', function() {
           _.assign(results.configuration, { productFields:[{value:'productLookups',import:"##noimport"}]})
          var rslt = pivotTable.importProductEntityList(results, m.importConfiguration(), [fakeProductEntity])
          expect(rslt.length, 1)
          expect(rslt[0].rows.length).toBe(2)
          expect(rslt[0].rows[0]).toEqual([ 'productProductId', 'productDescription','productNotes', 'productItemPrice', 'productProductImageUrl'])
          expect(rslt[0].rows[1]).toEqual([ 'ABCDE','Backpack', 'Finale test product', 11,'https://example.com/image-1.jpg'])
          expect(rslt[0].warnings).toEqual([])
          expect(rslt[0].infos).toEqual([])
          expect(rslt[0].syncStatus).toEqual('##ready')
          expect(rslt[0].userField).toEqual({attrName:'integration_etsysku_10001', attrValue:'HASH_9292 923 1500586325'})
        })
      })
  })

})})

})
