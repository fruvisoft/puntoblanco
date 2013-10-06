# -*- coding: utf-8 -*-

from flask import Flask
from . import order, user, admin, general

app = Flask(__name__)

app.register_blueprint(general.mod)
app.register_blueprint(admin.mod)
app.register_blueprint(user.mod)
app.register_blueprint(order.mod)

