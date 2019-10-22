


SELECT
  s.trans_id,
  @d:=COALESCE(CASE WHEN s.trans_type = 'debit' THEN s.amount END,0) as 'debit',
  @c:=COALESCE(CASE WHEN s.trans_type = 'credit' THEN s.amount END,0) as 'credit',
  @b := @b +  @d - @c
FROM
  (SELECT @b := 0.0) AS dummy
  CROSS JOIN
  ledger AS s
WHERE cus_id=1
ORDER BY
  trans_id;

select * from ledger