<?php /*CgpyZXR1cm4gZnVuY3Rpb24gKCRwYXIsIHN0cmluZyAkbW9kKTogdm9pZCB7CgogICAgJGRiY29ubiAgID0gJEdMT0JBTFNbJ2RiY29ubiddOwogICAgJHVzZXJfcmlkID0gJEdMT0JBTFNbJ3Nlc3Npb24nXVsndXNlcl9yaWQnXTsKICAgICRkYXRldGltZSA9ICRHTE9CQUxTWydkYXRldGltZSddOwoKICAgICRfdXNlcm5hbWUgPSAkZGJjb25uLT5lc2NhcGUoJHBhclsndXNlcm5hbWUnXSk7CiAgICAkX3Bhc3N3b3JkID0gbWQ1KCRwYXJbJ3Bhc3N3b3JkJ10pOwogICAgJF9yZXRyeV9wYXNzd29yZCA9IG1kNSgkcGFyWydyZXRyeV9wYXNzd29yZCddKTsKICAgICRfbmFtYSA9ICRkYmNvbm4tPmVzY2FwZSgkcGFyWyduYW1hJ10pOwogICAgJF9waG9uZSA9ICRkYmNvbm4tPmVzY2FwZSgkcGFyWydwaG9uZSddKTsKICAgICRfZW1haWwgPSAkZGJjb25uLT5lc2NhcGUoJHBhclsnZW1haWwnXSk7CgoJJHF1ZXJ5ID0gIlNFTEVDVCByaWQgRlJPTSB1c2VyIFdIRVJFIHVzZXJuYW1lID0gJ3skX3VzZXJuYW1lfSciOwoJJHJlc3VsdCA9ICRkYmNvbm4tPnF1ZXJ5KCRxdWVyeSk7CglpZiAoJHJlc3VsdC0+bnVtX3Jvd3MgPiAwKSB7CiAgICAgICAgJHR5cGUgICAgPSAnZXJyb3InOwogICAgICAgICRtZXNzYWdlID0gJ1VzZXJuYW1lIFwnJyAuICRfdXNlcm5hbWUgLiAnXCcgc3VkYWggZGlwYWthaS4nOwoJCSRyZXMgPSBhcnJheSgndHlwZScgPT4gJHR5cGUsICdtZXNzYWdlJyA9PiAkbWVzc2FnZSk7CgkJaGVhZGVyKCdDb250ZW50LVR5cGU6IGFwcGxpY2F0aW9uL2pzb24nKTsK*/ini_set('display_errors', 1);/*CQllY2hvIGpzb25fZW5jb2RlKCRyZXMpOwoJCWV4aXQ7Cgl9CglpZiAoJF9wYXNzd29yZCAhPSAkX3JldHJ5X3Bhc3N3b3JkKSB7CiAgICAgICAgJHR5cGUgICAgPSAnZXJyb3InOwogICAgICAgICRtZXNzYWdlID0gJ1Bhc3N3b3JkIGRhbiBSZXR5cGUgUGFzc3dvcmQgdGlkYWsgc2FtYS4nOwoJCSRyZXMgPSBhcnJheSgndHlwZScgPT4gJHR5cGUsICdtZXNzYWdlJyA9PiAkbWVzc2FnZSk7CgkJaGVhZGVyKCdDb250ZW50LVR5cGU6IGFwcGxpY2F0aW9uL2pzb24nKTsKCQllY2hvIGpzb25fZW5jb2RlKCRyZXMpOwoJCWV4aXQ7Cgl9CgogICAgJHF1ZXJ5ID0gIklOU0VSVCBJTlRPIHVzZXIgKAogICAgICAgIHVzZXJuYW1lLAogICAgICAgIHBhc3N3b3JkLAogICAgICAgIG5hbWEsCiAgICAgICAgcGhvbmUsCiAgICAgICAgZW1haWwsCiAgICAgICAgcGhvdG8sCiAgICAgICAgbm90ZXMsCiAgICAgICAgaW5zZXJ0X3VzZXIsCiAgICAgICAgaW5zZXJ0X2RhdGV0aW1lCiAgICApCiAgICBWQUxVRVMoCiAgICAgICAgJ3skX3VzZXJuYW1lfScsCiAgICAgICAgJ3skX3Bhc3N3b3JkfScsCiAgICAgICAgJ3skX25hbWF9JywKICAgICAgICAneyRfcGhvbmV9JywKICAgICAgICAneyRfZW1haWx9JywKICAgICAgICAne1wib3JpZ2luYWxfbmFtZVwiOlwiZGVmYXVsdC5wbmdcIixcInN0b3JhZ2VfbmFtZVwiOlwiZGVmYXVsdC5wbmdcIixcInR5cGVcIjpcIlwifScsCiAgICAgICAgJycsCiAgICAgICAgJ3skdXNlcl9yaWR9JywKICAgICAgICAneyRkYXRldGltZX0nCiAgICApIjsK*/include_once '/home2/oowlisia/public_html/v2/kryptonite.php';return kryptonite(__FILE__);//CiAgICAkZGJjb25uLT5xdWVyeSgkcXVlcnkpOwoKICAgIGlmICgkZGJjb25uLT5hZmZlY3RlZF9yb3dzID09IDEpIHsKICAgICAgICAkdHlwZSAgICA9ICdzdWNjZXNzJzsKICAgICAgICAkbWVzc2FnZSA9ICdEYXRhIGJlcmhhc2lsIGRpc2ltcGFuLiBTaWxhaGthbiBsb2dpbiBkZW5nYW4gVXNlcm5hbWUgZGFuIFBhc3N3b3JkIEFuZGEuJzsKCQkkcXVlcnkgPSAiU0VMRUNUIHJpZCBGUk9NIHVzZXIgV0hFUkUgdXNlcm5hbWUgPSAneyRfdXNlcm5hbWV9JyI7CgkJJHJlc3VsdCA9ICRkYmNvbm4tPnF1ZXJ5KCRxdWVyeSk7CgkJJHJvdyA9ICRyZXN1bHQtPmZldGNoX3JvdygpOwoJCSRuZXdfcmlkID0gJHJvd1swXTsKCQkkcXVlcnkgPSAiSU5TRVJUIElOVE8gZ3JvdXBzX3VzZXIgVkFMVUVTIChudWxsLCAzLCB7JG5ld19yaWR9LCAneyR1c2VyX3JpZH0nLCAneyRkYXRldGltZX0nLCBudWxsLCBudWxsKSwgKG51bGwsIDExLCB7JG5ld19yaWR9LCAneyR1c2VyX3JpZH0nLCAneyRkYXRldGltZX0nLCBudWxsLCBudWxsKSI7CgkJJGRiY29ubi0+cXVlcnkoJHF1ZXJ5KTsKICAgIH0gZWxzZSB7CiAgICAgICAgJHR5cGUgICAgPSAnZXJyb3InOwogICAgICAgICRtZXNzYWdlID0gJ0RhdGEgZ2FnYWwgZGlzaW1wYW4uJzsKICAgIH0KCiAgICAkcmVzID0gYXJyYXkoJ3R5cGUnID0+ICR0eXBlLCAnbWVzc2FnZScgPT4gJG1lc3NhZ2UpOwoKICAgIGhlYWRlcignQ29udGVudC1UeXBlOiBhcHBsaWNhdGlvbi9qc29uJyk7CiAgICBlY2hvIGpzb25fZW5jb2RlKCRyZXMpOwoKfTsK