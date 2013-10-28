import sqlalchemy as sa

username = 'root'
password = 'mnjhuy'
hostname = 'localhost'
port = '3306'
db = 'python_testdb2'

engine = sa.create_engine('mysql+mysqlconnector://%s:%s@%s:%s/%s' % (username, password, hostname, port, db), echo=True)

metadata = sa.MetaData()

users = sa.Table('users', metadata,
    sa.Column('id', sa.Integer, primary_key=True),
    sa.Column('name', sa.String(50)),
    sa.Column('fullname', sa.String(50)),
    )

addresses = sa.Table('addresses', metadata,
   sa.Column('id', sa.Integer, primary_key=True),
   sa.Column('user_id', None, sa.ForeignKey('users.id')),
   sa.Column('email_address', sa.String(50), nullable=False)
)