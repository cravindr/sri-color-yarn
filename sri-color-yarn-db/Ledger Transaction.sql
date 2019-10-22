(SELECT
  s.trans_id,
  s.desc,
  s.trans_date,
  @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
  @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
  @b := @b + @d - @c as 'totalamount'
FROM (SELECT @b := 0.0) AS dummy CROSS JOIN ledger AS s WHERE cus_id=25 ORDER BY trans_date, trans_id)


(SELECT
   s.trans_id,
   s.desc,
   s.trans_date,
   @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
   @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
   @b := @b + @d - @c as 'totalamount'
 FROM (SELECT @b := 0.0) AS dummy CROSS JOIN ledger AS s WHERE cus_id=25 and trans_date <  '2018-04-04'  ORDER BY trans_date, trans_id)

select @b

select * from  ledger where cus_id=25 and trans_date between  '2018-03-31' and '2018-04-04 23:59:59'

select * from  ledger where cus_id=25 and trans_date <  '2018-04-04'