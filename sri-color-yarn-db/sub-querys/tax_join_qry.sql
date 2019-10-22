SELECT tax.*,tax_group.tax_group_id  from tax
 LEFT JOIN tax_group ON (tax.tax_id IN( tax_group.tax_id_groups))
JOIN tax_zone ON (tax.tax_zone_id=tax_zone.zone_id)
WHERE  tax_group.tax_group_id=1



  SELECT *  FROM tax

SELECT  * FROM tax_group



SELECT tax.*,tax_zone.zone_desc FROM tax
  JOIN tax_zone ON (tax.tax_zone_id=tax_zone.zone_id)
  WHERE tax_zone.zone_codes in(33)

SELECT tax.*,
tax_zone.zone_desc,
tax_group.tax_groups_desc,
tax_group.tax_id_groups
FROM tax
JOIN tax_zone ON (tax.tax_zone_id=tax_zone.zone_id)
LEFT JOIN  tax_group ON(FIND_IN_SET(tax.tax_id,tax_group.tax_id_groups)>0)
WHERE find_in_set('33',tax_zone.zone_codes)>0 AND tax_group.tax_group_id=1


id
inv_id
inv_no
prod_id
prod_desc
hsn_code
qty
uom
price
total
discount
taxable_value
cgst_rate
cgst_amount
sgst_rate
sgst_amount
igst_rate
igst
tax_detail
