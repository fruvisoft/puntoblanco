#!/usr/bin/env python
# -*- coding: utf-8 -*-

from engine import *

conn = engine.connect()

ins = users.insert().values(name='jack', fullname='Jack Jones')
result = conn.execute(ins)

ins = users.insert()
conn.execute(ins, id=2, name='wendy', fullname='Wendy Williams') 

conn.execute(addresses.insert(), [ 
    {'user_id': 1, 'email_address' : 'jack@yahoo.com'},
    {'user_id': 1, 'email_address' : 'jack@msn.com'},
    {'user_id': 2, 'email_address' : 'www@www.org'},
    {'user_id': 2, 'email_address' : 'wendy@aol.com'},
])